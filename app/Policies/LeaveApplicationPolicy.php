<?php
namespace App\Policies;

use App\Enums\LeaveApplicationStatus;
use App\Models\LeaveApplication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeaveApplicationPolicy extends BasePolicy
{
    use HandlesAuthorization;

    public function approve(User $user, LeaveApplication $leaveApplication): bool
    {
        $ismanager = $user->role && $user->role->isManager();
        $status = $leaveApplication->status instanceof LeaveApplicationStatus
            ? $leaveApplication->status
            : LeaveApplicationStatus::tryFrom((string) $leaveApplication->status);
        $isPending = $status?->isPending();
        return $ismanager && $isPending;

    }

    public function reject(User $user, LeaveApplication $leaveApplication): bool
    {
        $ismanager = $user->role && $user->role->isManager();
        $isadmin = $user->role && $user->role->isAdmin();
        $status = $leaveApplication->status instanceof LeaveApplicationStatus
            ? $leaveApplication->status
            : LeaveApplicationStatus::tryFrom((string) $leaveApplication->status);
        $isPending = $status?->isPending();
        return ($ismanager || $isadmin) && $isPending;
    }

    public function cancel(User $user, LeaveApplication $leaveApplication): bool
    {
        $isAdmin = $user->role && $user->role->isAdmin();
        $isOwner = $leaveApplication->user_id === $user->id;
        $status = $leaveApplication->status instanceof LeaveApplicationStatus
            ? $leaveApplication->status
            : LeaveApplicationStatus::tryFrom((string) $leaveApplication->status);
        $isPending = $status?->isPending();

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

    public function view(User $user, LeaveApplication $leaveApplication): bool
    {
        if ($user->role && $user->role->isAdmin()) {
            return true;
        }

        if ($user->role && $user->role->isManager()) {
            $requestUser = $leaveApplication->user;
            if ($requestUser && $requestUser->role && $requestUser->role->isAdmin()) {
                return false;
            }

            return true;
        }

        return $leaveApplication->user_id === $user->id;
    }
    public function create(User $user, LeaveApplication $leaveApplication): bool
    {
        if ($user->role && ($user->role->isAdmin() || $user->role->isManager())) {
            return true;
        }
        if ($user->role && ($user->role->isEmployee() && $leaveApplication->user_id === $user->id)) {
            return true;
        }
        return false;
    }
    public function update(User $user, LeaveApplication $leaveApplication): bool
    {
        $isOwner = $leaveApplication->user_id === $user->id;
        return $isOwner;
    }
    public function delete(User $user, LeaveApplication $leaveApplication): bool
    {
        $isAdmin = $user->role && $user->role->isAdmin();
        $isOwner = $leaveApplication->user_id === $user->id;
        return $isAdmin || $isOwner;
    }
}
