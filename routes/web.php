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
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [\App\Http\Controllers\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [\App\Http\Controllers\AdminLoginController::class, 'login']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');

        Route::post('/logout', [\App\Http\Controllers\AdminLoginController::class, 'logout'])->name('admin.logout');
    });

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Users Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('contacts', AdminContactController::class);

    Route::resource('banners', BannerController::class);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');

    //products
    Route::resource('products', AdminProductController::class);
    // jobs
    // Route::resource('jobs', AdminJobController::class);

    // Route::delete('products/delete-image/{tourId}/{mediaId}', [AdminProductController::class, 'deleteImage'])
    //     ->name('products.deleteImage');

    // job applications
    // Route::resource('applications', JobApplicationController::class);


    // Route::get('about', [AboutController::class, 'edit'])->name('about.edit');
    // Route::post('about', [AboutController::class, 'updateOrCreate'])->name('about.updateOrCreate');


    // categories CRUD
    Route::resource('categories', CategoryController::class);
});

Auth::routes(['register' => false, 'login' => true, 'logout' => true, 'reset' => false, 'verify' => false]);
