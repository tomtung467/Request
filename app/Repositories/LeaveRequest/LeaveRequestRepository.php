<?php
namespace App\Repositories\LeaveRequest;
use App\Repositories\BaseRepository;
class LeaveRequestRepository extends BaseRepository implements ILeaveRequestRepository
{
    public function __construct(\App\Models\LeaveRequest $model)
    {
        $this->model = $model;
    }
}
