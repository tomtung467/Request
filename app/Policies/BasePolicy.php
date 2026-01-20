<?php
namespace App\Policies;
use App\Models\User;
use App\Models\LeaveApplication;
class BasePolicy
{
    //
    public function viewAny(User $user): bool
    {
        if ($user->role && $user->role->isAdmin()) {
            return true;
        }

        if ($user->role && $user->role->isManager()) {
            return true;
        }
        if ($user->role && $user->role->isEmployee()) {
            return true;
        }
        return false;
    }
    public function create(User $user): bool
    {
        if ($user->role && ($user->role->isAdmin() || $user->role->isManager())) {
            return true;
        }
        return false;
    }
}
