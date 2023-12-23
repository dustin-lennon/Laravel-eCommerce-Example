<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Post::observe(PostObserver::class);
        Paginator::useBootstrap();
        // View::share('site_name', 'MY SITE');
    }
}
