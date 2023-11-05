<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Idea;
use App\Models\User;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        // use this if you change IdeaPolicy to IdeaPermission class
        // Idea::class => IdeaPermission::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate => Permission | simple Role

        // Role
        Gate::define('admin', function(User $user) {
            return (bool) $user->is_admin;
        });

        // Permission
        // Gate::define('idea.delete', function(User $user, Idea $idea) {
        //     return (bool) $user->is_admin || $user->id === $idea->user_id;
        // });

        // Gate::define('idea.edit', function(User $user, Idea $idea) {
        //     return (bool) $user->is_admin || $user->id === $idea->user_id;
        // });
    }
}
