<?php

namespace App\Providers;

use App\Models\Category;
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

         View::composer('front.layouts.header', function ($view) {
            $categories = Category::query()->whereNull('parent_category_id')->get();

            $view->with('categories', $categories);
        });
    }
}
