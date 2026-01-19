<?php
namespace App\Services\LeaveApplication;
use App\Http\Requests\LeaveApplication\FilterLeaveApplicationRequest;
interface ILeaveApplicationService
{
    public function getAllWithFilter(FilterLeaveApplicationRequest $request);
    public function approve($id);
    public function reject($id);
    public function cancel($id);
    public function getPaginated($perPage = 10);
}
