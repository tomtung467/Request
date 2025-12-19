<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;
use App\Repositories\User\IUserRepository;
use App\Filters\UserFilter;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
