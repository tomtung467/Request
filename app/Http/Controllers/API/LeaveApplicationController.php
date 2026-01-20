<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseAPIController;
use App\Services\LeaveApplication\LeaveApplicationService;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\LeaveApplication\CreateLeaveRequest;
use App\Http\Requests\LeaveApplication\UpdateLeaveRequest;
use App\Http\Requests\LeaveApplication\FilterLeaveApplicationRequest;
use App\Http\Requests\LeaveApplication\RejectLeaveApplicationRequest;
use App\Http\Resources\LeaveApplicationResource;

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
            return $this->successResponse($leaveApplication);
    }
    public function update(UpdateLeaveRequest $request, $id)
    {
        $leaveApplication = $this->leaveApplicationService->getById($id);
        $validated = $request->validated();
        $leaveApplication = $this->leaveApplicationService->update($id, $validated);
        if (!$leaveApplication) {
            return $this->errorResponse(__('validation.not_found', ['attribute' => 'leave application']), 404);
        }
            return $this->successResponse($leaveApplication);
    }
    public function delete($id)
    {
        $leaveApplication = $this->leaveApplicationService->getById($id);
        $result = $this->leaveApplicationService->delete($id);
        if ($result) {
            return $this->successResponse(null, "Leave Application deleted successfully.");
        } else {
            return $this->errorResponse(__('validation.not_found', ['attribute' => 'leave application']), 404);
        }
    }
    public function approve($id)
    {
        $leaveApplication = $this->leaveApplicationService->getById($id);
        $leaveApplication = $this->leaveApplicationService->approve($id);
        if ($leaveApplication) {
            return $this->successResponse($leaveApplication, "Leave Application approved successfully.");
        } else {
            return $this->errorResponse(__('validation.not_found', ['attribute' => 'leave application']), 404);
        }
    }
    public function reject(RejectLeaveApplicationRequest $request, $id)
    {
        $validated = $request->validated();
        $rejected = $this->leaveApplicationService->reject($id);
        if ($rejected) {
            return $this->successResponse($rejected, "Leave Application rejected successfully.");
        }

        return $this->errorResponse(__('validation.not_found', ['attribute' => 'leave application']), 422);
    }
    public function cancel($id)
    {
        $cancelled = $this->leaveApplicationService->cancel($id);
        if ($cancelled) {
            return $this->successResponse($cancelled, "Leave Application cancelled successfully.");
        }
        return $this->errorResponse(__('validation.not_found', ['attribute' => 'leave application']), 422);
    }
}
