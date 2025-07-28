<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\TypicalBusinessController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\VipUserController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/nha-dat-ban', [App\Http\Controllers\Frontend\PropertyController::class, 'indexBan'])->name('properties.indexBan');
Route::get('/nha-dat/{id}', [App\Http\Controllers\Frontend\PropertyController::class, 'show'])->name('properties.show');
Route::get('/nha-dat-thue', [App\Http\Controllers\Frontend\PropertyController::class, 'indexThue'])->name('properties.indexThue');

Route::get('/du-an', function () {
    return view('pages.frontend.du_an');
});

Route::get('/tin-tuc', function () {
    return view('pages.frontend.tin_tuc');
});


Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Typical Business routes
    Route::get('/typical-business', [TypicalBusinessController::class, 'index'])->name('admin.typical_business.index');
    Route::get('/typical-business/create', [TypicalBusinessController::class, 'create'])->name('admin.typical_business.create');
    Route::post('/typical-business', [TypicalBusinessController::class, 'store'])->name('admin.typical_business.store');
    Route::get('/typical-business/{id}/edit', [TypicalBusinessController::class, 'edit'])->name('admin.typical_business.edit');
    Route::put('/typical-business/{id}', [TypicalBusinessController::class, 'update'])->name('admin.typical_business.update');
    Route::delete('/typical-business/{id}', [TypicalBusinessController::class, 'destroy'])->name('admin.typical_business.destroy');

    // Users route
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Property routes
    Route::get('/properties', [PropertyController::class, 'index'])->name('admin.properties.index');
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('admin.properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('admin.properties.store');
    Route::get('/properties/{id}/edit', [PropertyController::class, 'edit'])->name('admin.properties.edit');
    Route::put('/properties/{id}', [PropertyController::class, 'update'])->name('admin.properties.update');
    Route::delete('/properties/{id}', [PropertyController::class, 'destroy'])->name('admin.properties.destroy');

    // VIP Subscription routes
    Route::get('/vip-list-levels', [VipUserController::class, 'indexListLevel'])->name('admin.vip_users.indexListLevel');
    Route::get('/vip-users', [VipUserController::class, 'index'])->name('admin.vip_users.index');
    Route::get('/vip-users/create', [VipUserController::class, 'create'])->name('admin.vip_users.create');
    Route::post('/vip-users', [VipUserController::class, 'store'])->name('admin.vip_users.store');
    Route::get('/vip-users/{id}/edit', [VipUserController::class, 'edit'])->name('admin.vip_users.edit');
    Route::put('/vip-users/{id}', [VipUserController::class, 'update'])->name('admin.vip_users.update');
    Route::delete('/vip-users/{id}', [VipUserController::class, 'destroy'])->name('admin.vip_users.destroy');
});
