<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseAPIController;
use App\Services\User\UserService;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

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
            return $this->successResponse($user);
        } else {
            return $this->errorResponse(['message' => 'User not found'], 404);
        }
    }
    public function create(CreateUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
            $user = $this->userService->create($validated);
        if ($user) {
            return $this-> successResponse($user, 201);
        } else {
            return $this->errorResponse(['message' => 'User creation failed'], 500);
        }
    }
    public function update($id, UpdateUserRequest $request)
    {
        $validated = $request->all();
        $validated['password'] = bcrypt($validated['password']);
        $updatedUser = $this->userService->update($id, $validated);
        if ($updatedUser) {
            return $this->successResponse($updatedUser, "User updated successfully.");
        } else {
            return $this->errorResponse(['message' => 'User not found'], 404);
        }
    }
    public function delete($id)
    {
        $result = $this->userService->delete($id);
            return $this->successResponse(null, "User deleted successfully.",200);
    }
}
