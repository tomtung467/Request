<?php
namespace App\Repositories\LeaveRequest;
use App\Repositories\BaseRepository;
use App\Models\LeaveRequest;
class LeaveRequestRepository extends BaseRepository implements ILeaveRequestRepository
{
    public function __construct(LeaveRequest $model)
    {
        $this->model = $model;
    }
}
