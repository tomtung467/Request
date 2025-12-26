<?php
namespace App\Services\LeaveRequest;
interface ILeaveRequestService
{
    public function approve($id);
    public function reject($id);
    public function cancel($id);
}
