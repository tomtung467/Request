<?php
namespace App\Policies;
use App\Models\User;
use App\Policies\BasePolicy;
class UserPolicy extends BasePolicy
{
    //
    protected $policyName = 'User';
}
