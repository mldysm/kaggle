<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        View::composer('*', function ($view) {
        if (Route::is('datasets.*')) {
            $view->with('searchContext', 'datasets');
        } elseif (Route::is('competitions.*')) {
            $view->with('searchContext', 'competitions');
        } else {
            $view->with('searchContext', 'default');
        }
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
