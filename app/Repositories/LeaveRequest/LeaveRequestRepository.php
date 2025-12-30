<?php
namespace App\Repositories\LeaveRequest;

use App\Enums\UserEnum;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
class LeaveRequestRepository extends BaseRepository implements ILeaveRequestRepository
{
    public function __construct(LeaveRequest $model)
    {
        $this->model = $model;
    }
    public function getModel()
    {
        return LeaveRequest::class;
    }

    public function visibleTo(User $user): Builder
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
