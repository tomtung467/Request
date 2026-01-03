<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;

class UserPolicy extends BasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
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
    public function create(User $user): bool
    {
        return $user->role && $user->role->isAdmin();
    }
    public function update(User $user, User $model): bool
    {
        if ($user->role && $user->role->isAdmin()) {
            return true;
        }

        if ($user->role && $user->role->isManager()) {
            return !$model->role || !$model->role->isAdmin();
        }

        return $user->id === $model->id;
    }
    public function delete(User $user, User $model): bool
    {
        if ($user->role && $user->role->isAdmin()) {
            return true;
        }
        if ($user->role && $user->role->isManager()) {
            return !$model->role || !$model->role->isAdmin();
        }

        return $user->id === $model->id;
    }
}
