<?php

namespace App\Providers;

use App\Services\PageService;
use App\Services\PostService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(PostService::class, function ($app) {
            return new PostService();
        });

        $this->app->bind(PageService::class, function ($app) {
            return new PageService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
