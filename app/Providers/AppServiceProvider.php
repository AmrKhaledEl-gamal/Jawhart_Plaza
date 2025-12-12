<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Blade;
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
    public function boot(GeneralSettings $settings): void
    {
        Blade::anonymousComponentPath(resource_path('views/admin/components'));

        view()->share('settings', $settings);
    }
}
