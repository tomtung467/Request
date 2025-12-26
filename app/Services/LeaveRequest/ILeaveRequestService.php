<?php
namespace App\Services\LeaveRequest;
use App\Filters\LeaveApplicationFilter;
interface ILeaveRequestService
{
    public function getAllWithFilter(LeaveApplicationFilter $filter);
    public function approve($id);
    public function reject($id);
    public function cancel($id);
}
