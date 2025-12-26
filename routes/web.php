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
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\TrashController;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/menu', [MenuController::class, 'publicIndex'])->name('menu.index');
Route::get('/all-menu', [MenuController::class, 'allMenuIndex'])->name('all-menu.index');

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
    Route::patch('/profile/phone', [UserAuthController::class, 'updatePhone'])->name('user.profile.update.phone');

    // Indonesian Regions API
    Route::get('/api/regencies/{provinceId}', [UserAuthController::class, 'getRegencies'])->name('api.regencies');
    Route::get('/api/districts/{regencyId}', [UserAuthController::class, 'getDistricts'])->name('api.districts');
    Route::get('/api/villages/{districtId}', [UserAuthController::class, 'getVillages'])->name('api.villages');
});


Route::name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard');

    // Role Management Routes
    Route::prefix('mng-role')->name('role.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::get('/{role}', [RoleController::class, 'show'])->name('show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::patch('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('toggleStatus');
    });

    // User Management Routes
    Route::prefix('mng-user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Menu Management Routes
    Route::prefix('mng-menu')->name('menu.')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('index');
        Route::get('/create', [MenuController::class, 'create'])->name('create');
        Route::post('/store', [MenuController::class, 'store'])->name('store');
        Route::get('/{menu}', [MenuController::class, 'show'])->name('show');
        Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
        Route::patch('/{menu}', [MenuController::class, 'update'])->name('update');
        Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy');
    });

    // Sponsor Management Routes
    Route::prefix('mng-sponsor')->name('sponsor.')->group(function () {
        Route::get('/', [SponsorController::class, 'index'])->name('index');
        Route::get('/create', [SponsorController::class, 'create'])->name('create');
        Route::post('/store', [SponsorController::class, 'store'])->name('store');
        Route::get('/{sponsor}', [SponsorController::class, 'show'])->name('show');
        Route::get('/{sponsor}/edit', [SponsorController::class, 'edit'])->name('edit');
        Route::patch('/{sponsor}', [SponsorController::class, 'update'])->name('update');
        Route::delete('/{sponsor}', [SponsorController::class, 'destroy'])->name('destroy');
        Route::post('/{sponsor}/toggle-status', [SponsorController::class, 'toggleStatus'])->name('toggle');
    });

    // Kategori Management Routes
    Route::prefix('mng-kategori')->name('kategori.')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('index');
        Route::get('/create', [KategoriController::class, 'create'])->name('create');
        Route::post('/store', [KategoriController::class, 'store'])->name('store');
        Route::get('/{kategori}', [KategoriController::class, 'show'])->name('show');
        Route::get('/{kategori}/edit', [KategoriController::class, 'edit'])->name('edit');
        Route::patch('/{kategori}', [KategoriController::class, 'update'])->name('update');
        Route::delete('/{kategori}', [KategoriController::class, 'destroy'])->name('destroy');
    });

    // Hero Management Routes
    Route::prefix('mng-hero')->name('hero.')->group(function () {
        Route::get('/', [HeroController::class, 'index'])->name('index');
        Route::get('/create', [HeroController::class, 'create'])->name('create');
        Route::post('/store', [HeroController::class, 'store'])->name('store');
        Route::get('/{hero}', [HeroController::class, 'show'])->name('show');
        Route::get('/{hero}/edit', [HeroController::class, 'edit'])->name('edit');
        Route::patch('/{hero}', [HeroController::class, 'update'])->name('update');
        Route::delete('/{hero}', [HeroController::class, 'destroy'])->name('destroy');
        Route::post('/{hero}/toggle-status', [HeroController::class, 'toggleStatus'])->name('toggle');
    });

    // About & Contact Management Routes
    Route::prefix('mng-about')->name('about_contact.')->group(function () {
        Route::get('/', [AboutContactController::class, 'index'])->name('index');
        Route::get('/create', [AboutContactController::class, 'create'])->name('create');
        Route::post('/store', [AboutContactController::class, 'store'])->name('store');
        Route::get('/{about_contact}', [AboutContactController::class, 'show'])->name('show');
        Route::get('/{about_contact}/edit', [AboutContactController::class, 'edit'])->name('edit');
        Route::patch('/{about_contact}', [AboutContactController::class, 'update'])->name('update');
        Route::delete('/{about_contact}', [AboutContactController::class, 'destroy'])->name('destroy');
    });

    // Pesanan (Order) Management Routes
    Route::prefix('mng-pesanan')->name('pesanan.')->group(function () {
        Route::get('/', [PesananController::class, 'index'])->name('index');
        Route::get('/export-csv', [PesananController::class, 'exportCsv'])->name('exportCsv');
        Route::get('/export-print', [PesananController::class, 'exportPrint'])->name('exportPrint');
        Route::get('/create', [PesananController::class, 'create'])->name('create');
        Route::post('/store', [PesananController::class, 'store'])->name('store');
        Route::get('/{pesanan}', [PesananController::class, 'show'])->name('show');
        Route::get('/{pesanan}/edit', [PesananController::class, 'edit'])->name('edit');
        Route::patch('/{pesanan}', [PesananController::class, 'update'])->name('update');
        Route::delete('/{pesanan}', [PesananController::class, 'destroy'])->name('destroy');
    });

    // System Management Routes (Maintenance, Backup, Logs)
    Route::prefix('mng-system')->name('system.')->group(function () {
        Route::get('/', [SystemController::class, 'index'])->name('index');
        Route::post('/maintenance', [SystemController::class, 'toggleMaintenance'])->name('maintenance');
        Route::post('/backup', [SystemController::class, 'createBackup'])->name('backup.create');
        Route::get('/backup/download/{filename}', [SystemController::class, 'downloadBackup'])->name('backup.download');
        Route::delete('/backup/delete/{filename}', [SystemController::class, 'deleteBackup'])->name('backup.delete');
        Route::post('/logs/clear', [SystemController::class, 'clearLogs'])->name('logs.clear');
    });

    // Trash Management Routes
    Route::prefix('mng-trash')->name('trash.')->group(function () {
        Route::get('/', [TrashController::class, 'index'])->name('index');
        Route::post('/restore/{type}/{id}', [TrashController::class, 'restore'])->name('restore');
        Route::delete('/delete/{type}/{id}', [TrashController::class, 'forceDelete'])->name('delete');
        Route::post('/restore-all/{type}', [TrashController::class, 'restoreAll'])->name('restoreAll');
        Route::delete('/empty/{type}', [TrashController::class, 'emptyTrash'])->name('empty');
    });
});

