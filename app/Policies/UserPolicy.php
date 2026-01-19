<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;

class UserPolicy extends BasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function delete(User $user, User $model): bool
    {
        $isadmin = $user->role && $user->role->isAdmin();
        $ismanager = $user->role && $user->role->isManager();
        return $isadmin || ($ismanager && (!$model->role || !$model->role->isAdmin()));
    }
    public function view(User $user, User $model): bool
    {
        if ($user->role && $user->role->isAdmin()) {
            return true;
        }

        if ($user->role && $user->role->isManager()) {
            if ($model->role && $model->role->isAdmin()) {
                return false;
            }

            return true;
        }

        return $user->id === $model->id;
    }
}
