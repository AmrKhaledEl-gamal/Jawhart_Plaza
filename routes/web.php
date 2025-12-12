<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
// use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/change-lang/{lang}', function ($lang) {
    session(['locale' => $lang]);
    app()->setLocale($lang);
    return back();
})->name('lang.switch');


// // Front Routes
// Route::group(['as' => 'front.'], function () {
//     Route::get('/', HomeController::class)->name('index');
//     // contact
//     Route::get('/contact', [ContactController::class, 'index'])->name('contact');
//     Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
//     Route::get('/job', [JobController::class, 'index'])->name('job');
//     Route::post('/job', [JobController::class, 'store'])->name('job.store');

//     Route::get('/products', [ProductController::class, 'index'])->name('products.index');
//     // Route::get('/Products/{slug}', [ProductController::class, 'show'])->name('Products.show');

//     Route::get('/about', [FrontAboutController::class, 'about'])->name('about');
// });


// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Authentication Routes
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [\App\Http\Controllers\AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [\App\Http\Controllers\AdminLoginController::class, 'login']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard.index');
        })->name('dashboard');

        Route::post('/logout', [\App\Http\Controllers\AdminLoginController::class, 'logout'])->name('logout');

        // Resource Routes
        Route::resource('users', UserController::class);
        Route::resource('contacts', AdminContactController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('products', AdminProductController::class);
        Route::resource('categories', CategoryController::class);

        // Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    });
});

// Auth::routes(['register' => false, 'login' => true, 'logout' => true, 'reset' => false, 'verify' => false]);
