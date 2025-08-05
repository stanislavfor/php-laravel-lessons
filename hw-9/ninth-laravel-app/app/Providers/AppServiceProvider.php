<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Events\NewsHidden;
use App\Listeners\NewsHiddenListener;
use App\Models\News;
use App\Observers\NewsObserver;

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
//    public function boot(): void
//    {
//        //
//    }



    public function boot()
    {
        News::observe(NewsObserver::class);
    }

    protected $listen = [
        NewsHidden::class => [
            NewsHiddenListener::class,
        ],
    ];
}
