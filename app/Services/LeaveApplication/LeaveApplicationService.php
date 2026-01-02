<?php
namespace App\Services\LeaveApplication;
use App\Services\BaseService;
use App\Repositories\LeaveApplication\ILeaveApplicationRepository;
use App\Services\LeaveApplication\ILeaveApplicationService;
use App\Filters\LeaveApplicationFilter;
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
        $user = auth()->user();
        $query = $this->leaveApplicationRepository-> VisibleTo($user)->with('user');

        return $query->filter($filter)->get();
    }
    public function approve($id)
    {
            $user = $this->leaveApplicationRepository->find($id);
            if (!$user) {
                return null;
            } else if ($user->status == 'pending')
                {
                    $user->status = 'accepted';
                    $user->save();
                    return $user;
                }
    }
    public function reject($id)
    {
          $user = $this->leaveApplicationRepository->find($id);
        if (!$user) {
            return null;
        } else if ($user->status == 'pending')
            {
                $user->status = 'rejected';
                $user->save();
                return $user;
            }
    }
    public function cancel($id)
    {
          $user = $this->leaveApplicationRepository->find($id);
        if (!$user) {
            return null;
        } else if ($user->status == 'pending')
            {
                $user->status = 'cancelled';
                $user->save();
                return $user;
            }
    }
    public function getPaginated($perPage = 10)
    {
        $user = auth()->user();
        $query = $this->leaveApplicationRepository->visibleTo($user)->with('user');

        return $query->paginate($perPage);
    }
}
