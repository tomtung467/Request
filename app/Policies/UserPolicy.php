<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;

class UserPolicy extends BasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function view(User $user,$id): bool
    {
        $model = User::find($id);
        if (!$model) {
            return false;
        }
        if ($user->role && $user->role->isAdmin()) {
            return true;
        }
        if ($user->role && $user->role->isManager()) {
            return !$model->role->isAdmin();
        }
        if ($user->role && $user->role->isEmployee()) {
            return $model->id === $user->id;
        }
        return false;
    }

    public function delete(User $user, $id): bool
    {
        $model = User::find($id);
        $isadmin = $user->role && $user->role->isAdmin();
        $ismanager = $user->role && $user->role->isManager();
        return $isadmin || ($ismanager && (!$model->role || !$model->role->isAdmin()));
    }
    public function update(User $user, $id): bool
    {
        $model = User::find($id);
        $isadmin = $user->role && $user->role->isAdmin();
        $ismanager = $user->role && $user->role->isManager();
        $isowner = $user->id === $model->id;
        return $isadmin || ($ismanager && (!$model->role || !$model->role->isAdmin())) || $isowner;
    }
}
