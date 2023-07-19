<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('App\Contracts\Dao\AdminDaoInterface', 'App\Dao\AdminDao');
        $this->app->bind('App\Contracts\Dao\PublicDaoInterface', 'App\Dao\PublicDao');
        $this->app->bind('App\Contracts\Dao\UserDaoInterface', 'App\Dao\UserDao');
        // Business logic registration
        $this->app->bind('App\Contracts\Services\AdminServiceInterface', 'App\Services\AdminService');
        $this->app->bind('App\Contracts\Services\PublicServiceInterface', 'App\Services\PublicService');
        $this->app->bind('App\Contracts\Services\UserServiceInterface', 'App\Services\UserService');


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
