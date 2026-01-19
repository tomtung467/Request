<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseAPIController;
use App\Services\LeaveApplication\LeaveApplicationService;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\LeaveApplication\CreateLeaveRequest;
use App\Http\Requests\LeaveApplication\UpdateLeaveRequest;
use App\Filters\LeaveApplicationFilter;
use App\Http\Requests\LeaveApplication\FilterLeaveApplicationRequest;
use App\Http\Requests\LeaveApplication\RejectLeaveApplicationRequest;
use Illuminate\Http\Request;
use App\Http\Resources\LeaveApplicationResource;
use App\Models\LeaveApplication;

class LeaveApplicationController extends BaseAPIController
{
    protected $leaveApplicationService;
    use ApiResponseTrait;

    public function __construct(LeaveApplicationService $leaveApplicationService)
    {
        $this->leaveApplicationService = $leaveApplicationService;
        $this->middleware('auth:api');

    }
    public function get(FilterLeaveApplicationRequest $request)
    {
        $leaveApplications = $this->leaveApplicationService->getAllWithFilter($request);
        return $this->successResponse($leaveApplications);
    }
    public function list()
    {
        $leaveApplications = $this->leaveApplicationService->getPaginated();
        return $this->successResponse(LeaveApplicationResource::collection($leaveApplications));
    }
    public function create(CreateLeaveRequest $request)
    {
        $validated = $request->validated();
        $leaveApplication = $this->leaveApplicationService->create($validated);
        return $this->successResponse($leaveApplication, 201);
    }
    public function detail($id)
    {
        $leaveApplication = $this->leaveApplicationService->getById($id);
        if ($leaveApplication) {
            return $this->successResponse($leaveApplication);
        } else {
            return $this->errorResponse('Leave Application not found', 404);
        }
    }
    public function update(UpdateLeaveRequest $request, $id)
    {
        $leaveApplication = $this->leaveApplicationService->getById($id);
        $validated = $request->validated();
        $leaveApplication = $this->leaveApplicationService->update($id, $validated);
        if ($leaveApplication) {
            return $this->successResponse($leaveApplication);
        } else {
            return $this->errorResponse('Leave Application not found', 404);
        }
    }
    public function delete($id)
    {
        $leaveApplication = $this->leaveApplicationService->getById($id);
        if (!$leaveApplication) {
            return $this->errorResponse('Leave Application not found', 404);
        }
        $result = $this->leaveApplicationService->delete($id);
        if ($result) {
            return $this->successResponse(null, "Leave Application deleted successfully.");
        } else {
            return $this->errorResponse('Leave Application not found', 404);
        }
    }
    public function approve($id)
    {
        $leaveApplication = $this->leaveApplicationService->getById($id);
        if (!$leaveApplication) {
            return $this->errorResponse('Leave Application not found', 404);
        }

        $leaveApplication = $this->leaveApplicationService->approve($id);
        if ($leaveApplication) {
            return $this->successResponse($leaveApplication, "Leave Application approved successfully.");
        } else {
            return $this->errorResponse('Leave Application not found or cannot be approved', 404);
        }
    }
    public function reject(RejectLeaveApplicationRequest $request, $id)
    {
        $validated = $request->validated();
        $leaveApplication = $this->leaveApplicationService->getById($id);
        if (!$leaveApplication) {
            return $this->errorResponse('Leave Application not found', 404);
        }

        $rejected = $this->leaveApplicationService->reject($id);
        if ($rejected) {
            return $this->successResponse($rejected, "Leave Application rejected successfully.");
        }

        return $this->errorResponse('Leave Application cannot be rejected', 422);
    }
    public function cancel($id)
    {
        $leaveApplication = $this->leaveApplicationService->getById($id);
        if (!$leaveApplication) {
            return $this->errorResponse('Leave Application not found', 404);
        }

        $cancelled = $this->leaveApplicationService->cancel($id);
        if ($cancelled) {
            return $this->successResponse($cancelled, "Leave Application cancelled successfully.");
        }

        return $this->errorResponse('Leave Application cannot be cancelled', 422);
    }
}
