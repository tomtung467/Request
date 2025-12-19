<?php
namespace App\Services\LeaveRequest;
use App\Services\BaseService;
use App\Repositories\LeaveRequest\ILeaveRequestRepository;
class LeaveRequestService extends BaseService implements ILeaveRequestService
{
    protected $leaveRequestRepository;

    public function __construct(ILeaveRequestRepository $leaveRequestRepository)
    {
        parent::__construct($leaveRequestRepository);
        $this->leaveRequestRepository = $leaveRequestRepository;
    }
}
