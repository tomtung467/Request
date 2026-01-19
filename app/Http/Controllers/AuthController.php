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
            /** @var User $user */
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

        return $this->successResponse(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        $refreshToken = request('refresh_token');
        if (! $refreshToken) {
            return $this->errorResponse('refresh_token is required', 400);
        }
        try {
            $decoded = JWTAuth::manager()->getJWTProvider()->decode($refreshToken);
            if ($decoded['type'] !== 'refresh') {
                return $this->errorResponse(['error' => 'this is not the refresh_token'], 404);
            }
            $user = $this->userService->getById($decoded['sub']);
            $token = $this->guard()->login($user);
            $refreshToken = $this->createRefreshToken($user);
            return $this->successResponse([
                'access_token' => $token,
                'refresh_token' => $refreshToken,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60
            ]);
        } catch (JWTException $exception) {
            return $this->errorResponse('Invalid refresh token', 401);
        }
    }
    private function createRefreshToken(User $user)
    {
    $payload = $user->getJWTRefreshcustomClaims();
        // Thêm thời gian hết hạn (exp)
    $payload['exp'] = time() + config('jwt.refresh_ttl') * 60;
    return JWTAuth::manager()->getJWTProvider()->encode($payload);
    }

    /**
     * @return \Tymon\JWTAuth\JWTGuard
     */
    private function guard()
    {
        return Auth::guard('api');
    }

}
