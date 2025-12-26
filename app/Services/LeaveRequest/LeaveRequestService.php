<?php
namespace App\Services\LeaveRequest;
use App\Services\BaseService;
use App\Repositories\LeaveRequest\ILeaveRequestRepository;
use App\Filters\LeaveApplicationFilter;
class LeaveRequestService extends BaseService implements ILeaveRequestService
{
    protected $leaveRequestRepository;

    public function __construct(ILeaveRequestRepository $leaveRequestRepository)
    {
        parent::__construct($leaveRequestRepository);
        $this->leaveRequestRepository = $leaveRequestRepository;
    }

    public function getAllWithFilter(LeaveApplicationFilter $filter)
    {
        $data = $this->leaveRequestRepository->allWithFilter($filter);
        return $data;
    }
    public function approve($id)
    {
            $user = $this->leaveRequestRepository->find($id);
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
          $user = $this->leaveRequestRepository->find($id);
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
          $user = $this->leaveRequestRepository->find($id);
        if (!$user) {
            return null;
        } else if ($user->status == 'accepted')
            {
                $user->status = 'cancelled';
                $user->save();
                return $user;
            }
    }
}
