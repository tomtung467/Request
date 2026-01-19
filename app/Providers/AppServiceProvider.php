<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\LeaveApplication\ILeaveApplicationRepository;
use App\Repositories\LeaveApplication\LeaveApplicationRepository;
use App\Services\User\IUserService;
use App\Services\User\UserService;
use App\Services\LeaveApplication\ILeaveApplicationService;
use App\Services\LeaveApplication\LeaveApplicationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use App\Models\LeaveApplication;
use App\Models\User;
use App\Policies\LeaveApplicationPolicy;
use App\Policies\UserPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            IUserRepository::class,
            UserRepository::class
        );
        $this->app->bind(
            ILeaveApplicationRepository::class,
            LeaveApplicationRepository::class
        );
        $this ->app->bind(
            IUserService::class,
            UserService::class
        );
        $this ->app->bind(
            ILeaveApplicationService::class,
            LeaveApplicationService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Gate::policy(LeaveApplication::class, LeaveApplicationPolicy::class);
        Gate::policy(User::class, UserPolicy::class);

        if (app()->environment('local')) {
        DB::listen(function ($query) {
            Log::info($query->sql);
            Log::info($query->bindings);
            Log::info($query->time);
        });
    }
    }
}
