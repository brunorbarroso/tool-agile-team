<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\TaskRepositoryInterface','App\Repositories\TaskRepository');
        $this->app->bind('App\Contracts\ParameterRepositoryInterface','App\Repositories\ParameterRepository');
        $this->app->bind('App\Contracts\RoleRepositoryInterface','App\Repositories\RoleRepository');
    }
}
