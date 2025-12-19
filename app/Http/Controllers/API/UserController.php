<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseAPIController;
use App\Services\User\UserService;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends BaseAPIController
{
    protected $userService;
    use ApiResponseTrait;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function get()
    {
        $users = $this->userService->getAll();
        return $this->successResponse($users);
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
        $data = $request->all();
        $newUser = $this->userService->create($data);
        if ($newUser) {
            return $this-> successResponse($newUser, 201);
        } else {
            return $this->errorResponse(['message' => 'User creation failed'], 500);
        }
    }
    public function update($id, UpdateUserRequest $request)
    {
        $data = $request->all();
        $updatedUser = $this->userService->update($id, $data);
        if ($updatedUser) {
            return $this->successResponse($updatedUser, "User updated successfully.");
        } else {
            return $this->errorResponse(['message' => 'User not found'], 404);
        }
    }
    public function delete($id)
    {
        $result = $this->userService->delete($id);
        if ($result) {
            return $this->successResponse(null, "User deleted successfully.");
        } else {
            return $this->errorResponse(['message' => 'User not found'], 404);
        }
    }
}
