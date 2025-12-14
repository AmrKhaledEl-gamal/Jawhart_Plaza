<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
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


    Route::resource('banners', BannerController::class);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');

    // Products
    Route::resource('products', AdminProductController::class);

    Route::resource('products', AdminProductController::class);

    Route::delete('products/delete-image/{tourId}/{mediaId}', [AdminProductController::class, 'deleteImage'])
        ->name('products.deleteImage');

    Route::resource('contacts', AdminContactController::class);

    Route::resource('colors', ColorController::class)->except('show');
    Route::resource('sizes', SizeController::class)->except('show');


    //ProductVariantController
    Route::post('products/{product}/variants', [\App\Http\Controllers\Admin\ProductVariantController::class, 'store'])
        ->name('products.variants.store');
    Route::delete('products/{product}/variants/{variant}', [\App\Http\Controllers\Admin\ProductVariantController::class, 'destroy'])
        ->name('products.variants.destroy');




    // categories CRUD
    Route::resource('categories', CategoryController::class);
});

Auth::routes(['register' => false, 'login' => true, 'logout' => true, 'reset' => false, 'verify' => false]);
