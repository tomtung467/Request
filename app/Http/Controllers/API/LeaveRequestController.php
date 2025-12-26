<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseAPIController;
use App\Services\LeaveRequest\LeaveRequestService;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\LeaveRequest\CreateLeaveRequest;
use App\Http\Requests\LeaveRequest\UpdateLeaveRequest;
use App\Filters\LeaveApplicationFilter;
use Illuminate\Http\Request;

class LeaveRequestController extends BaseAPIController
{
    protected $leaveRequestService;
    use ApiResponseTrait;

    public function __construct(LeaveRequestService $leaveRequestService)
    {
        $this->leaveRequestService = $leaveRequestService;
        $this->middleware('auth:api');

    }
    public function get(Request $request)
    {
        $filter = new LeaveApplicationFilter($request);
        $leaveRequests = $this->leaveRequestService->getAllWithFilter( $filter);
        return $this->successResponse($leaveRequests);
    }
    public function create(CreateLeaveRequest $request)
    {
        $validated = $request->validated();
        $leaveRequest = $this->leaveRequestService->create($validated);
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
        $validated = $request->validated();
        $leaveRequest = $this->leaveRequestService->update($id, $validated);
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
    public function approve($id)
    {
        $leaveRequest = $this->leaveRequestService->approve($id);
        if ($leaveRequest) {
            return $this->successResponse($leaveRequest, "Leave Request approved successfully.");
        } else {
            return $this->errorResponse('Leave Request not found or cannot be approved', 404);
        }
    }
    public function reject($id)
    {
        $leaveRequest = $this->leaveRequestService->reject($id);
        if ($leaveRequest) {
            return $this->successResponse($leaveRequest, "Leave Request rejected successfully.");
        } else {
            return $this->errorResponse('Leave Request not found or cannot be rejected', 404);
        }
    }
    public function cancel($id)
    {
        $leaveRequest = $this->leaveRequestService->cancel($id);
        if ($leaveRequest) {
            return $this->successResponse($leaveRequest, "Leave Request cancelled successfully.");
        } else {
            return $this->errorResponse('Leave Request not found or cannot be cancelled', 404);
        }
    }
}
