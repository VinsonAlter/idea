<?php

namespace App\Providers;

use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
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

        // by default, topUsers aren't viewable in Laravel debugbar, so set this up first, if you want to check
        Debugbar::enable();

        // Cache An Eloquent Query
        // Method 1, Via Cache Facade, first argument is key, second argument is ttl A.K.A time to live, third is a default value, via a closure
        // use 60 * 2 as reminder it's 2 minutes
        // $topUsers = Cache::remember('topUsers', 60 * 2,  function() {
            // need to return the cache
        //     return User::withCount('ideas')
        //     ->orderBy('ideas_count', 'DESC')
        //     ->limit(10)->get();
        // });

        // clear entire cache without php artisan cache:clear
        // Cache::flush();
        // or deleting certain cache
        Cache::forget('topUsers');
        // this function is also the same as above
        // cache()->forget('topUsers');

        // but via time is inefficient, use Carbon to pass ttl instead, in this example, add 5 minutes,
        // there's also rememberForever() method inside Cache, just keep the cache forever
        $topUsers = Cache::remember('topUsers', Carbon::now()->addMinutes(5),  function() {
            // need to return the cache
            return User::withCount('ideas')
            ->orderBy('ideas_count', 'DESC')
            ->limit(10)->get();
        });

        // sharing views to all routes, use View Facades
        // View::share('topUsers', 
        //     User::withCount('ideas')
        //     ->orderBy('ideas_count', 'DESC')
        //     ->limit(10)->get();
        // );

        // shorthanded via cache, loaded via cache, to make loading process faster
        View::share('topUsers',
            $topUsers
        );

        /* for dynamic localization reason, set language for applications */
        // app()->setLocale('id');
        /* via Facades Library */
        // App::setLocale('id');
    }
}
