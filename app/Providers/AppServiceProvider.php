<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('App\Contracts\Dao\AdminDaoInterface', 'App\Dao\AdminDao');
        
        // Business logic registration
        $this->app->bind('App\Contracts\Services\AdminServiceInterface', 'App\Services\AdminService');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
