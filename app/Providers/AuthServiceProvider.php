<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        // Permission of CRUD Task
        Gate::define('create-task', function ($user) {
            return $user->hasAccess(['create-task']);
        });
        Gate::define('update-task', function ($user) {
            return $user->hasAccess(['update-task']);
        });
        Gate::define('view-task', function ($user) {
            return $user->hasAccess(['view-task']);
        });
        Gate::define('destroy-task', function ($user) {
            return $user->hasAccess(['destroy-task']);
        });

        // Permission of CRUD User
        Gate::define('create-user', function ($user) {
            return $user->hasAccess(['create-user']);
        });
        Gate::define('update-user', function ($user) {
            return $user->hasAccess(['update-user']);
        });
        Gate::define('view-user', function ($user) {
            return $user->hasAccess(['view-user']);
        });
        Gate::define('destroy-user', function ($user) {
            return $user->hasAccess(['destroy-user']);
        });

        // Permission of CRUD Parameter
        Gate::define('create-parameter', function ($user) {
            return $user->hasAccess(['create-parameter']);
        });
        Gate::define('update-parameter', function ($user) {
            return $user->hasAccess(['update-parameter']);
        });
        Gate::define('view-parameter', function ($user) {
            return $user->hasAccess(['view-parameter']);
        });
        Gate::define('destroy-parameter', function ($user) {
            return $user->hasAccess(['destroy-parameter']);
        });
    }
}
