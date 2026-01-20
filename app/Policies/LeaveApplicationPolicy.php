<?php
namespace App\Policies;

use App\Enums\LeaveApplicationStatus;
use App\Models\LeaveApplication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeaveApplicationPolicy extends BasePolicy
{
    use HandlesAuthorization;

    public function update(User $user,$id): bool
    {
        $leaveApplication = LeaveApplication::find($id);
        $isAdmin = $user->role && $user->role->isAdmin();
        $isOwner = $leaveApplication->user_id === $user->id;
        $status = $leaveApplication->status instanceof LeaveApplicationStatus
            ? $leaveApplication->status
            : LeaveApplicationStatus::tryFrom((string) $leaveApplication->status);
        $isPending = $status?->isPending();

        return $isAdmin || ($isOwner && $isPending);
    }

    public function approve(User $user, $id): bool
    {
        $leaveApplication = LeaveApplication::find($id);
        $ismanager = $user->role && $user->role->isManager();
        $status = $leaveApplication->status instanceof LeaveApplicationStatus
            ? $leaveApplication->status
            : LeaveApplicationStatus::tryFrom((string) $leaveApplication->status);
        $isPending = $status?->isPending();
        return $ismanager && $isPending;

    }

    public function reject(User $user, $id): bool
    {
        $leaveApplication = LeaveApplication::find($id);
        $ismanager = $user->role && $user->role->isManager();
        $isadmin = $user->role && $user->role->isAdmin();
        $status = $leaveApplication->status instanceof LeaveApplicationStatus
            ? $leaveApplication->status
            : LeaveApplicationStatus::tryFrom((string) $leaveApplication->status);
        $isPending = $status?->isPending();
        return ($ismanager || $isadmin) && $isPending;
    }

    public function cancel(User $user, $id): bool
    {
        $leaveApplication = LeaveApplication::find($id);
        $isAdmin = $user->role && $user->role->isAdmin();
        $isOwner = $leaveApplication->user_id === $user->id;
        $status = $leaveApplication->status instanceof LeaveApplicationStatus
            ? $leaveApplication->status
            : LeaveApplicationStatus::tryFrom((string) $leaveApplication->status);
        $isPending = $status?->isPending();

        return $isAdmin || ($isOwner && $isPending);
    }

    public function view(User $user, $id): bool
    {
        $leaveApplication = LeaveApplication::find($id);
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
    public function delete(User $user, $id): bool
    {
        $leaveApplication = LeaveApplication::find($id);
        $isAdmin = $user->role && $user->role->isAdmin();
        $isOwner = $leaveApplication->user_id === $user->id;
        return $isAdmin || $isOwner;
    }
}
