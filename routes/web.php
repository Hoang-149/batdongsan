<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CKEditorController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProjectController;
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
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/du-an', [HomeController::class, 'projects'])->name('projects');
Route::get('/tin-tuc', [HomeController::class, 'news'])->name('news');
Route::get('/tin-tuc/{id}', [HomeController::class, 'newsDetail'])->name('news.detail');

Route::get('/nha-dat-ban', [App\Http\Controllers\Frontend\PropertyController::class, 'indexBan'])->name('properties.indexBan');

Route::get('/nha-dat/{id}', [App\Http\Controllers\Frontend\PropertyController::class, 'show'])->name('properties.show');

Route::get('/nha-dat-thue', [App\Http\Controllers\Frontend\PropertyController::class, 'indexThue'])->name('properties.indexThue');

Route::get('/dang-tin', [App\Http\Controllers\Frontend\PropertyController::class, 'createProperty'])->name('createProperty');

Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');


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

    // Project routes
    Route::get('/project', [ProjectController::class, 'index'])->name('admin.project.index');
    Route::get('/project/create', [ProjectController::class, 'create'])->name('admin.project.create');
    Route::post('/project', [ProjectController::class, 'store'])->name('admin.project.store');
    Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->name('admin.project.edit');
    Route::put('/project/{id}', [ProjectController::class, 'update'])->name('admin.project.update');
    Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('admin.project.destroy');

    // News routes
    Route::get('/news', [NewsController::class, 'index'])->name('admin.news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/news/{id}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('admin.news.destroy');

    // VIP Subscription routes
    Route::get('/vip-list-levels', [VipUserController::class, 'indexListLevel'])->name('admin.vip_users.indexListLevel');
    Route::get('/vip-users', [VipUserController::class, 'index'])->name('admin.vip_users.index');
    Route::get('/vip-users/create', [VipUserController::class, 'create'])->name('admin.vip_users.create');
    Route::post('/vip-users', [VipUserController::class, 'store'])->name('admin.vip_users.store');
    Route::get('/vip-users/{id}/edit', [VipUserController::class, 'edit'])->name('admin.vip_users.edit');
    Route::put('/vip-users/{id}', [VipUserController::class, 'update'])->name('admin.vip_users.update');
    Route::delete('/vip-users/{id}', [VipUserController::class, 'destroy'])->name('admin.vip_users.destroy');
});


// php artisan config:clear
// php artisan route:clear
// php artisan cache:clear
// php artisan view:clear
