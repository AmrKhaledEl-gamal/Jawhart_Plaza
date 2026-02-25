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

        view()->composer('front.*', function ($view) {
            if (\Illuminate\Support\Facades\Auth::check()) {
                $sidebarCartItems = \App\Models\Cart::with(['product' => function ($q) {
                    $q->select('id', 'name', 'slug', 'price');
                }, 'variant'])->where('user_id', \Illuminate\Support\Facades\Auth::id())->latest()->get();

                $sidebarTotal = $sidebarCartItems->sum(function ($item) {
                    $price = $item->variant->price ?? $item->product->price;
                    return $price * $item->quantity;
                });
                $cartCount = $sidebarCartItems->count();
                $wishlistCount = \App\Models\Wishlist::where('user_id', \Illuminate\Support\Facades\Auth::id())->count();
            } else {
                $sidebarCartItems = collect();
                $sidebarTotal = 0;
                $cartCount = 0;
                $wishlistCount = 0;
            }

            $view->with('sidebarCartItems', $sidebarCartItems);
            $view->with('sidebarTotal', $sidebarTotal);
            $view->with('cartCount', $cartCount);
            $view->with('wishlistCount', $wishlistCount);
        });
    }
}
