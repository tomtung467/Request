<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseAPIController;
use App\Services\LeaveRequest\LeaveRequestService;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\LeaveApplication\CreateLeaveRequest;
use App\Http\Requests\LeaveApplication\UpdateLeaveRequest;
use App\Filters\LeaveApplicationFilter;
use App\Http\Requests\LeaveApplication\RejectLeaveApplicationRequest;
use Illuminate\Http\Request;
use App\Http\Resources\LeaveRequestResource;
use App\Models\LeaveRequest;

class LeaveRequestController extends BaseAPIController
{
    protected $leaveRequestService;
    use ApiResponseTrait;

    public function __construct(LeaveRequestService $leaveRequestService)
    {
        $this->leaveRequestService = $leaveRequestService;
        //$this->middleware('auth:api');

    }
    public function get(Request $request)
    {
        $this->authorize('viewAny', LeaveRequest::class);
        $filter = new LeaveApplicationFilter($request);
        $leaveRequests = $this->leaveRequestService->getAllWithFilter( $filter);
        return $this->successResponse($leaveRequests);
    }
    public function list(Request $request)
    {
        $this->authorize('viewAny', LeaveRequest::class);
        $leaveRequests = $this->leaveRequestService->getPaginated();
        return $this->successResponse(LeaveRequestResource::collection($leaveRequests));
    }
    public function create(CreateLeaveRequest $request)
    {
        $validated = $request->validated();
        $leaveRequest = new LeaveRequest($validated); 
        $this->authorize('create', $leaveRequest);
        $leaveRequest = $this->leaveRequestService->create($validated);
        return $this->successResponse($leaveRequest, 201);
    }
    public function detail($id)
    {
        $leaveRequest = $this->leaveRequestService->getById($id);
        if ($leaveRequest) {
            $this->authorize('view', $leaveRequest);
            return $this->successResponse($leaveRequest);
        } else {
            return $this->errorResponse('Leave Request not found', 404);
        }
    }
    public function update(UpdateLeaveRequest $request, $id)
    {
        $leaveRequest = $this->leaveRequestService->getById($id);
        $validated = $request->validated();
        $this->authorize('update', $leaveRequest);
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
        $leaveRequest = $this->leaveRequestService->getById($id);
        if (!$leaveRequest) {
            return $this->errorResponse('Leave Request not found', 404);
        }
        $this->authorize('approve', $leaveRequest);

        $leaveRequest = $this->leaveRequestService->approve($id);
        if ($leaveRequest) {
            return $this->successResponse($leaveRequest, "Leave Request approved successfully.");
        } else {
            return $this->errorResponse('Leave Request not found or cannot be approved', 404);
        }
    }
    public function reject(RejectLeaveApplicationRequest $request, $id)
    {
        $validated = $request->validated();
        $leaveRequest = $this->leaveRequestService->getById($id);
        if (!$leaveRequest) {
            return $this->errorResponse('Leave Request not found', 404);
        }

        $this->authorize('reject', $leaveRequest);

        $rejected = $this->leaveRequestService->reject($id);
        if ($rejected) {
            return $this->successResponse($rejected, "Leave Request rejected successfully.");
        }

        return $this->errorResponse('Leave Request cannot be rejected', 422);
    }
    public function cancel($id)
    {
        $leaveRequest = $this->leaveRequestService->getById($id);
        if (!$leaveRequest) {
            return $this->errorResponse('Leave Request not found', 404);
        }

        $this->authorize('cancel', $leaveRequest);

        $cancelled = $this->leaveRequestService->cancel($id);
        if ($cancelled) {
            return $this->successResponse($cancelled, "Leave Request cancelled successfully.");
        }

        return $this->errorResponse('Leave Request cannot be cancelled', 422);
    }
}
