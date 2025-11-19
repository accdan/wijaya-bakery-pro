<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutContactController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserAuthController;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/promotions', [PromoController::class, 'frontendIndex'])->name('promotions.index');
Route::get('/promo/{id}', [PromoController::class, 'frontendShow'])->name('promo.view');
Route::post('/promo/{promoId}/add-to-cart/{menuId}', [PromoController::class, 'addToCartFromPromo'])->name('promo.add.to.cart');

// User Profile Order Details
Route::middleware(['auth'])->get('/profile/orders/{timestamp}', [UserAuthController::class, 'orderDetail'])->name('user.order.detail');
Route::post('/pesanan/store', [PesananController::class, 'storeFromUser'])->name('pesanan.store.fromuser');

// User Authentication Routes
Route::get('/login-user', [UserAuthController::class, 'showLoginForm'])->name('user.login.form');
Route::post('/login-user', [UserAuthController::class, 'login'])->name('user.login');
Route::get('/register-user', [UserAuthController::class, 'showRegisterForm'])->name('user.register.form');
Route::post('/register-user', [UserAuthController::class, 'register'])->name('user.register');

// Password Reset Routes (Simplified for Local Development)
Route::get('/forgot-password', [UserAuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [UserAuthController::class, 'resetPasswordSimple'])->name('password.reset.simple');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google Auth Routes
Route::get('/auth/google', [UserAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [UserAuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Admin Auth Routes
Route::get('/login-admin', [AuthController::class, 'showAdminLoginForm'])->name('login-admin');
Route::post('/login-admin', [AuthController::class, 'adminLogin'])->name('login-admin.post');

// User Cart Routes (protected by auth middleware in controller)
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{menuId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart/update/{cartId}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::delete('/cart/remove-multiple', [CartController::class, 'removeMultipleFromCart'])->name('cart.remove.multiple');

    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/profile', [UserAuthController::class, 'profile'])->name('user.profile');
    Route::patch('/profile/address', [UserAuthController::class, 'updateAddress'])->name('user.profile.update.address');

    // Indonesian Regions API
    Route::get('/api/regencies/{provinceId}', [UserAuthController::class, 'getRegencies'])->name('api.regencies');
    Route::get('/api/districts/{regencyId}', [UserAuthController::class, 'getDistricts'])->name('api.districts');
    Route::get('/api/villages/{districtId}', [UserAuthController::class, 'getVillages'])->name('api.villages');
});


Route::name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('role', RoleController::class);
    Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
    Route::resource('promo', PromoController::class);
    Route::resource('user', UserController::class);
    Route::resource('menu', MenuController::class);

    Route::resource('sponsor', SponsorController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('hero', HeroController::class);
    Route::resource('about_contact',AboutContactController::class);
    Route::resource('pesanan', PesananController::class);
});
