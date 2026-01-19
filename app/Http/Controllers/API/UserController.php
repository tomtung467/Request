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
            return $this->errorResponse("User not found", 404);
        }
    }
    public function create(CreateUserRequest $request)
    {
        $validated = $request->validated();
        $newUser = $this->userService->create($validated);
        return $this->successResponse($newUser, "User created successfully.",201);
    }
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userService->getById($id);
        if (!$user) {
            return $this->errorResponse(['message' => 'User not found'], 404);
        }
        $validated = $request->validated();
        // Filter out null values to preserve existing data for fields not provided
        $dataToUpdate = array_filter($validated, fn($value) => $value !== null);
        $updatedUser = $this->userService->update($id, $dataToUpdate);
        return $this->successResponse($updatedUser, "User updated successfully.");
    }
    public function delete($id)
    {
        $user = $this->userService->getById($id);
        if (!$user) {
            return $this->errorResponse("User not found", 404);
        }

        $result = $this->userService->delete($id);
        return $this->successResponse(null, "User deleted successfully.",200);
    }
}
