<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User; // Add this line
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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
        $this->registerPolicies();

        Gate::resource('post', PostPolicy::class);

        Gate::define('viewAppSettings', fn (User $user) => $user->email === 'topukhan@gmail.com');
    }
}
