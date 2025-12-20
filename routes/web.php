<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WholesaleController as AdminWholesaleController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\WholesaleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/change-lang/{lang}', function ($lang) {
    session(['locale' => $lang]);
    app()->setLocale($lang);
    return back();
})->name('lang.switch');


// Front Routes
Route::group(['as' => 'front.'], function () {
    Route::get('/', HomeController::class)->name('index');


    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    // Route::get('/Products/{slug}', [ProductController::class, 'show'])->name('Products.show');

    Route::get('/about', function () {
        return view('front.about');
    })->name('about');

    //contact us
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    //wholesale
    Route::get('/wholesale', [WholesaleController::class, 'index'])->name('wholesale.index');
    Route::post('/wholesale', [WholesaleController::class, 'store'])->name('wholesale.store');
    //shop
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
});


// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:admin']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Admins Routes
    Route::get('/admins', [UserController::class, 'index'])->name('admins.index');
    Route::get('/admins/create', [UserController::class, 'create'])->name('admins.create');
    Route::post('/admins', [UserController::class, 'store'])->name('admins.store');
    Route::get('/admins/{user}/edit', [UserController::class, 'edit'])->name('admins.edit');
    Route::put('/admins/{user}', [UserController::class, 'update'])->name('admins.update');
    Route::get('/admins/{user}', [UserController::class, 'show'])->name('admins.show');
    Route::delete('/admins/{user}', [UserController::class, 'destroy'])->name('admins.destroy');

    // Banners
    Route::resource('banners', BannerController::class);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');

    // Products
    Route::resource('products', AdminProductController::class)->except('show');

    Route::delete('products/delete-image/{product}/{mediaId}', [AdminProductController::class, 'deleteImage'])
        ->name('products.deleteImage');

    // ProductVariantController
    Route::post('products/{product}/variants', [\App\Http\Controllers\Admin\ProductVariantController::class, 'store'])
        ->name('products.variants.store');
    Route::delete('products/{product}/variants/{variant}', [\App\Http\Controllers\Admin\ProductVariantController::class, 'destroy'])
        ->name('products.variants.destroy');

    // Contacts
    Route::resource('contacts', AdminContactController::class);

    // wholesales
    Route::resource('wholesales', AdminWholesaleController::class);

    // Attributes
    Route::resource('colors', ColorController::class)->except('show');
    Route::resource('sizes', SizeController::class)->except('show');


    // Categories
    Route::resource('categories', CategoryController::class);

    // Missing Admin modules
    Route::get('carts', [CartController::class, 'index'])->name('carts.index');
    Route::resource('coupons', CouponController::class)->except('show');
    Route::resource('faqs', FaqController::class)->except('show');
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
});

Auth::routes(['register' => false, 'login' => true, 'logout' => true, 'reset' => false, 'verify' => false]);
