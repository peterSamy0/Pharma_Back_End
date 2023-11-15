<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

   /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is_pharmacy', function ($user) {
            return $user->role == 'pharmacy';
        });
    
        Gate::define('is_client', function ($user) {
            return $user->role == 'client';
        });
    
        Gate::define('is_delivery', function ($user) {
            return $user->role == 'delivery';
        });

        Gate::define('is_admin', function ($user) {
            return $user->role == 'admin';
        });
    }
}
