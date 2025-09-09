<?php

namespace App\Providers;

use App\Models\WorkHour;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('front.layouts.footer', function ($view) {
            $workHours = WorkHour::get();

            $view->with('workHours', $workHours);
        });
    }
}
