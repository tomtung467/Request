<?php
namespace App\Policies;

use App\Enums\LeaveApplicationStatus;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeaveRequestPolicy extends BasePolicy
{
    use HandlesAuthorization;

    public function approve(User $user, LeaveRequest $leaveRequest): bool
    {
        $ismanager = $user->role && $user->role->isManager();
        $statusValue = $leaveRequest->status instanceof LeaveApplicationStatus
            ? $leaveRequest->status->value
            : (string) $leaveRequest->status;
        $isPending = $statusValue === LeaveApplicationStatus::pending;
        return $ismanager && $isPending;

    }

    public function reject(User $user, LeaveRequest $leaveRequest): bool
    {
        $ismanager = $user->role && $user->role->isManager();
        $isadmin = $user->role && $user->role->isAdmin();
        $statusValue = $leaveRequest->status instanceof LeaveApplicationStatus
            ? $leaveRequest->status->value
            : (string) $leaveRequest->status;
        $isPending = $statusValue === LeaveApplicationStatus::pending;
        return ($ismanager || $isadmin) && $isPending;
    }

    public function cancel(User $user, LeaveRequest $leaveRequest): bool
    {
        $isAdmin = $user->role && $user->role->isAdmin();
        $isOwner = $leaveRequest->user_id === $user->id;
        $statusValue = $leaveRequest->status instanceof LeaveApplicationStatus
            ? $leaveRequest->status->value
            : (string) $leaveRequest->status;
        $isPending = $statusValue === LeaveApplicationStatus::pending;

        return $isAdmin || ($isOwner && $isPending);
    }
}
