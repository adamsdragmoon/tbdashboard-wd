<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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
     */
    public function boot(): void
    {
        //
        Gate::define('user', function (User $user) {
        return $user->role === 'user';
        });

        Gate::define('superuser', function (User $user) {
        return $user->role === 'superuser';
        });
        
        Gate::define('admin', function (User $user) {
        return $user->role === 'admin';
        });

        Gate::define('superadmin', function (User $user) {
        return $user->role === 'superadmin';
        });

        Gate::define('cs', function (User $user) {
        return $user->department === 'cs';
        });

        Gate::define('fin', function (User $user) {
        return $user->department === 'fin';
        });

        Gate::define('all', function (User $user) {
        return $user->department === 'all';
        });

        Gate::define('access-closeShift', function ($user) {
            return in_array($user->role, ['superuser', 'admin', 'superadmin']);
        });

        Gate::define('access-deleteShift', function ($user) {
            return in_array($user->role, ['admin', 'superadmin']);
        });

        Gate::define('access-user', function ($user) {
            return in_array($user->role, ['admin', 'superadmin']);
        });

    }
}
