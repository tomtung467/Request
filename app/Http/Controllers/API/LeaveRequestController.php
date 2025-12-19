<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseAPIController;
use Illuminate\Http\Request;
use App\Services\LeaveRequest\LeaveRequestService;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\LeaveRequest\CreateLeaveRequest;
use App\Http\Requests\LeaveRequest\UpdateLeaveRequest;

class LeaveRequestController extends BaseAPIController
{
    protected $leaveRequestService;
    use ApiResponseTrait;

    public function __construct(LeaveRequestService $leaveRequestService)
    {
        $this->leaveRequestService = $leaveRequestService;
    }
    public function get()
    {
        $leaveRequests = $this->leaveRequestService->getAll();
        return $this->successResponse($leaveRequests);
    }
    public function create(CreateLeaveRequest $request)
    {
        $data = $request->all();
        $leaveRequest = $this->leaveRequestService->create($data);
        return $this->successResponse($leaveRequest, 201);
    }
    public function detail($id)
    {
        $leaveRequest = $this->leaveRequestService->getById($id);
        if ($leaveRequest) {
            return $this->successResponse($leaveRequest);
        } else {
            return $this->errorResponse('Leave Request not found', 404);
        }
    }
    public function update(UpdateLeaveRequest $request, $id)
    {
        $data = $request->all();
        $leaveRequest = $this->leaveRequestService->update($id, $data);
        if ($leaveRequest) {
            return $this->successResponse($leaveRequest);
        } else {
            return $this->errorResponse('Leave Request not found', 404);
        }
    }
    public function delete($id)
    {
        $result = $this->leaveRequestService->delete($id);
        if ($result) {
            return $this->successResponse(null, "Leave Request deleted successfully.");
        } else {
            return $this->errorResponse('Leave Request not found', 404);
        }
    }

    // Define your API methods here
}
