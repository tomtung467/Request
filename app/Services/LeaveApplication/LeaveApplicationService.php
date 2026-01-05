<?php
namespace App\Services\LeaveApplication;
use App\Services\BaseService;
use App\Repositories\LeaveApplication\ILeaveApplicationRepository;
use App\Services\LeaveApplication\ILeaveApplicationService;
use App\Filters\LeaveApplicationFilter;
use App\Enums\LeaveApplicationStatus;
class LeaveApplicationService extends BaseService implements ILeaveApplicationService
{
    protected $leaveApplicationRepository;

    public function __construct(ILeaveApplicationRepository $leaveApplicationRepository)
    {
        parent::__construct($leaveApplicationRepository);
        $this->leaveApplicationRepository = $leaveApplicationRepository;
    }

    public function getAllWithFilter(LeaveApplicationFilter $filter)
    {
        $user = auth()->guard()->user();
        $query = $this->repository->visibleTo($user)->with('user');

        return $query->filter($filter)->get();
    }
    public function approve($id)
    {
        $leave = $this->leaveApplicationRepository->find($id);
        if (! $leave) {
            return null;
        }

        $status = $leave->status instanceof LeaveApplicationStatus
            ? $leave->status
            : LeaveApplicationStatus::tryFrom((string) $leave->status);

        if (! $status?->isPending()) {
            return null;
        }

        $leave->status = LeaveApplicationStatus::ACCEPTED->value;
        $leave->save();

        return $leave;
    }
    public function reject($id)
    {
        $leave = $this->leaveApplicationRepository->find($id);
        if (! $leave) {
            return null;
        }

        $status = $leave->status instanceof LeaveApplicationStatus
            ? $leave->status
            : LeaveApplicationStatus::tryFrom((string) $leave->status);

        if (! $status?->isPending()) {
            return null;
        }

        $leave->status = LeaveApplicationStatus::REJECTED->value;
        $leave->save();

        return $leave;
    }
    public function cancel($id)
    {
        $leave = $this->leaveApplicationRepository->find($id);
        if (! $leave) {
            return null;
        }

        $status = $leave->status instanceof LeaveApplicationStatus
            ? $leave->status
            : LeaveApplicationStatus::tryFrom((string) $leave->status);

        if (! $status?->isPending()) {
            return null;
        }

        $leave->status = LeaveApplicationStatus::CANCELLED->value;
        $leave->save();

        return $leave;
    }
    public function getPaginated($perPage = 10)
    {
        $user = auth()->guard()->user();
        $query = $this->repository->visibleTo($user)->with('user');

        return $query->paginate($perPage);
    }
}
