<?php
namespace App\Repositories\LeaveApplication;

use App\Enums\UserEnum;
use App\Models\LeaveApplication;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
class LeaveApplicationRepository extends BaseRepository implements ILeaveApplicationRepository
{
    public function __construct(LeaveApplication $model)
    {
        $this->model = $model;
    }
    public function getModel()
    {
        return LeaveApplication::class;
    }

    public function VisibleTo(User $user): Builder
    {
        $query = $this->model->newQuery();

        if ($user->role && $user->role->isAdmin()) {
            return $query;
        }

        if ($user->role && $user->role->isManager()) {
            return $query->whereHas('user', function (Builder $builder) {
                $builder->where('role', '!=', UserEnum::ADMIN);
            });
        }

        return $query->where('user_id', $user->id);
    }
}
