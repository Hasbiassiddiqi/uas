<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('owner-only', function ($user) {
            return $user->role === 'Owner';
        });
        Gate::define('staff-only', function ($user) {
            return $user->role === 'Staff';
        });
        Gate::define('pembeli-only', function ($user) {
            return $user->role === 'Pembeli';
        });
        Gate::define('loggedin-only', function ($user) {
            return Auth::check();
        });
    }
}