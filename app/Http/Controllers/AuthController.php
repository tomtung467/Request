<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\ApiResponseTrait;

class AuthController extends BaseAPIController
{
    protected $userService;
    use ApiResponseTrait;
        public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth:api', ['except' => ['login','refresh','register']]);
    }
    public function register(CreateUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = $this->userService->create($data);

        return $this->successResponse($user, 'User registered successfully', 201);
    }
    public function login()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! $token = $this->guard()->attempt($credentials)) {
            return $this->errorResponse('Unauthorized', 401);
        }

        $refreshToken = $this->createRefreshToken($this->guard()->user());
        return $this->respondWithToken($token, $refreshToken);
    }

    private function respondWithToken($token, $refreshToken)
    {
        return $this->successResponse([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60
        ]);
    }
    public function profile()
    {
        try {
            $user = $this->guard()->user();
            $user->load('leaveApplications');
            return $this->successResponse($user);
        } catch (JWTException $e) {
            return $this->errorResponse('Could not retrieve user profile', 401);
        }
    }
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        $refreshToken = request('refresh_token');
        if (! $refreshToken) {
            return $this->errorResponse('refresh_token is required', 400);
        }
        try {
            $decoded = JWTAuth::manager()->getJWTProvider()->decode($refreshToken);
            try {
                $user = User::find($decoded['subac']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'this is not the refresh_token'], 404);
            }

            if (! $user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $token = $this->guard()->login($user);
            $refreshToken = $this->createRefreshToken($user);
            return $this->respondWithToken($token, $refreshToken);
        } catch (JWTException $exception) {
            return $this->errorResponse('Invalid refresh token', 401);
        }
    }
    private function createRefreshToken(User $user)
    {
        $refreshToken = JWTAuth::manager()->getJWTProvider()->encode([
            'subac'    => $user->id,
            'random' => (string) (rand() . time()),
            'exp'    => time() + config('jwt.refresh_ttl') * 60,
        ]);
        return $refreshToken;
    }

    /**
     * @return \Tymon\JWTAuth\JWTGuard
     */
    private function guard()
    {
        return Auth::guard('api');
    }

}
