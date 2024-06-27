<?php

namespace App\Providers;

use App\Extensions\LengthAwarePaginator;
use Illuminate\Support\Facades\App;
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
        $this->app->bind(
            \Illuminate\Pagination\LengthAwarePaginator::class,
            LengthAwarePaginator::class
        );
    }
}
