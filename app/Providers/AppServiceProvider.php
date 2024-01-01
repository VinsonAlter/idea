<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // sharing views to all routes, use View Facades
        View::share('topUsers', 
            User::withCount('ideas')
            ->orderBy('ideas_count', 'DESC')
            ->limit(5)->get()
        );

        /* for dynamic localization reason, set language for applications */
        // app()->setLocale('id');
        /* via Facades Library */
        // App::setLocale('id');
    }
}
