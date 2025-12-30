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
    public function viewAny(User $user): bool
    {
        if ($user->role && $user->role->isAdmin()) {
            return true;
        }

        if ($user->role && $user->role->isManager()) {
            return true;
        }

        return $user->role && $user->role->isEmployee();
    }

    public function view(User $user, LeaveRequest $leaveRequest): bool
    {
        if ($user->role && $user->role->isAdmin()) {
            return true;
        }

        if ($user->role && $user->role->isManager()) {
            $requestUser = $leaveRequest->user;
            if ($requestUser && $requestUser->role && $requestUser->role->isAdmin()) {
                return false;
            }

            return true;
        }

        return $leaveRequest->user_id === $user->id;
    }
    public function create(User $user, LeaveRequest $leaveRequest): bool
    {
        if ($user->role && ($user->role->isAdmin() || $user->role->isManager())) {
            return true;
        }
        if ($user->role && ($user->role->isEmployee() && $leaveRequest->user_id === $user->id)) {
            return true;
        }
        return false;
    }
    public function update(User $user, LeaveRequest $leaveRequest): bool
    {
        $isOwner = $leaveRequest->user_id === $user->id;
        return $isOwner;
    }
}
