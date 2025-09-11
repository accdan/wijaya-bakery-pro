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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/login-admin', [AuthController::class, 'showAdminLoginForm'])->name('login-admin');
Route::post('/login-admin', [AuthController::class, 'adminLogin'])->name('login-admin.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/menu', [MenuController::class, 'page'])->name('user.menu');
Route::name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard.admin');
    Route::resource('role', RoleController::class);
    Route::post('role/{id}/toggle-status', [RoleController::class, 'toggleStatus'])->name('role.toggleStatus');
    Route::resource('promo', PromoController::class);
    Route::resource('user', UserController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('sponsor', SponsorController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('hero', HeroController::class);
    Route::resource('about_contact',AboutContactController::class);
});

Route::name('users')->middleware('users')->group(function () {
});