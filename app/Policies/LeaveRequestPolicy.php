<?php
namespace App\Policies;
use App\Models\LeaveRequest;
use App\Policies\BasePolicy;
class LeaveRequestPolicy extends BasePolicy
{
    //
    protected $policyName = 'LeaveRequest';
}
