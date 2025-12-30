<?php
namespace App\Services\LeaveApplication;
use App\Filters\LeaveApplicationFilter;
interface ILeaveApplicationService
{
    public function getAllWithFilter(LeaveApplicationFilter $filter);
    public function approve($id);
    public function reject($id);
    public function cancel($id);
    public function getPaginated($perPage = 10);
}
