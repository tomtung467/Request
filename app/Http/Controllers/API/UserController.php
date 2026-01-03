<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseAPIController;
use App\Services\User\UserService;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

use function Symfony\Component\Translation\t;

class UserController extends BaseAPIController
{
    protected $userService;
    use ApiResponseTrait;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth:api');
    }
    public function get()
    {
        $users = $this->userService->getAll();
        return $this->successResponse(UserResource::collection($users), "Data retrieved successfully.");
    }
    public function list()
    {
        $users = $this->userService->getPaginated();
        return $this->successResponse(UserResource::collection($users), "Data retrieved successfully.");
    }
 public function detail($id)
    {
        $user = $this->userService->getById($id);
        if ($user) {
            return $this->successResponse(new UserResource($user->load('leaveApplications')));
        } else {
            return $this->errorResponse(['message' => 'User not found'], 404);
        }
    }
    public function create(CreateUserRequest $request)
    {
        $validated = $request->validated();
        $this -> authorize('create', User::class);
        $newUser = $this->userService->create($validated);
        return $this->successResponse($newUser, "User created successfully.",201);
    }
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userService->getById($id);                
        if (!$user) {
            return $this->errorResponse(['message' => 'User not found'], 404);
        }
        $this->authorize('update', $user);
        $validated = $request->validated();
        $updatedUser = $this->userService->update($id, $validated);
        return $this->successResponse($updatedUser, "User updated successfully.");
    }
    public function delete($id)
    {
        $user = $this->userService->getById($id);
        if (!$user) {
            return $this->errorResponse(['message' => 'User not found'], 404);
        }

        $this->authorize('delete', $user);

        $result = $this->userService->delete($id);
        return $this->successResponse(null, "User deleted successfully.",200);
    }
}
