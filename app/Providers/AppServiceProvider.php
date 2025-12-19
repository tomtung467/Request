<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\LeaveRequest\ILeaveRequestRepository;
use App\Repositories\LeaveRequest\LeaveRequestRepository;
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
            ILeaveRequestRepository::class,
            LeaveRequestRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
