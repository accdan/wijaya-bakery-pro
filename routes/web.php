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

// Route::get('/homepage', [HomepageController::class, 'index']);
// Route::get('/home', [HomeController::class, 'index']);
// Route::get('/login-user', [AuthController::class, 'showUserLoginForm'])->name('login-user');
// Route::post('/login-user', [AuthController::class, 'userLogin']);
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
// Route::get('/auth-google-redirect', [AuthController::class, 'googleRedirect']);
// Route::get('/auth-google-callback', [AuthController::class, 'googleCallback']);
Route::name('users')->middleware('users')->group(function () {
    //    Route::get('/homepage', [DashboardUserController::class, 'homepage'])->name('users.homepage.user');
    //     Route::get('/dashboard-user', [DashboardUserController::class, 'index'])->name('users.dashboard.user');
    //     Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
//     Route::get('/menu/{id}/detail', [MenuController::class, 'detail'])->name('menu.detail');
//     Route::get('/kategori-list', [DashboardUserController::class, 'kategoriList'])->name('user.kategori-list');
//     Route::get('/kategori/{id}', [DashboardUserController::class, 'menuByKategori'])->name('user.menu-by-kategori');
});

// Route::get('/test-translate', function () {
//     return view('test-translate');
// });
// require base_path('routes/api.php');
