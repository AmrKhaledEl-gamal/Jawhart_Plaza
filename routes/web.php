<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Admin\CategoryController;
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
    // contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    // Route::get('/Products/{slug}', [ProductController::class, 'show'])->name('Products.show');

});


// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Users Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    Route::resource('banners', BannerController::class);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');

    //products
    Route::resource('products', AdminProductController::class);
    // jobs

    Route::delete('products/delete-image/{tourId}/{mediaId}', [AdminProductController::class, 'deleteImage'])
        ->name('products.deleteImage');

    // job applications




    // categories CRUD
    Route::resource('categories', CategoryController::class);
});

Auth::routes(['register' => false, 'login' => true, 'logout' => true, 'reset' => false, 'verify' => false]);
