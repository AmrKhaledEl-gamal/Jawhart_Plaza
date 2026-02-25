<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CartController as AdmincartController;
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
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\TrackOrderController;
use App\Http\Controllers\Front\WholesaleController;
use App\Http\Controllers\Front\WishlistController;
use App\Http\Controllers\Front\PageController;
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

    // Products
    Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('/terms-conditions', [PageController::class, 'termsConditions'])->name('terms-conditions');
    Route::get('/buying-guide', [PageController::class, 'buyingGuide'])->name('buying-guide');
    Route::get('/faq', [PageController::class, 'faq'])->name('faq');

    //contact us
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    //wholesale
    Route::get('/wholesale', [WholesaleController::class, 'index'])->name('wholesale.index');
    Route::post('/wholesale', [WholesaleController::class, 'store'])->name('wholesale.store');
    //shop
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

    // Auth Routes (Guest only)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
    });

    // Auth Routes (Authenticated only)
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Cart routes
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::get('/cart/count', [CartController::class, 'getCartItemCount'])->name('cart.count');
        Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
        Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
        Route::delete('/cart-clear', [CartController::class, 'clear'])->name('cart.clear');

        // Wishlist routes
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
        Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
        Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
        Route::post('/wishlist/{wishlist}/move-to-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');

        // Reviews (authenticated only)
        Route::post('/products/{product}/review', [ProductController::class, 'storeReview'])->name('products.review');

        //checkout
        Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
        Route::get('checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
        // Track order
        Route::get('/track-order', [TrackOrderController::class, 'index'])->name('track-order.index');
        Route::post('/track-order', [TrackOrderController::class, 'track'])->name('track-order.track');
    });
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
    Route::get('carts', [AdmincartController::class, 'index'])->name('carts.index');
    Route::resource('coupons', CouponController::class)->except('show');
    Route::resource('faqs', FaqController::class)->except('show');
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
});

// Admin Auth Routes (for admin login)
Route::group(['prefix' => 'admin'], function () {
    Auth::routes(['register' => false, 'login' => true, 'logout' => true, 'reset' => false, 'verify' => false]);
});
