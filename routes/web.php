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
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Http;
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
Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [LoginController::class, 'register']);

Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/thong-tin-ca-nhan', [HomeController::class, 'profile'])->name('profile');
Route::post('/thong-tin-ca-nhan/update', [HomeController::class, 'updateProfile'])->name('profile.update');

Route::get('/du-an', [HomeController::class, 'projects'])->name('projects');
Route::get('/du-an/{slug}', [HomeController::class, 'projectDetail'])->name('project.detail');
Route::get('/tin-tuc', [HomeController::class, 'news'])->name('news');
Route::get('/tin-tuc/{slug}', [HomeController::class, 'newsDetail'])->name('news.detail');

Route::get('/nha-dat-ban', [App\Http\Controllers\Frontend\PropertyController::class, 'indexBan'])->name('properties.indexBan');

Route::get('/nha-dat/{slug}', [App\Http\Controllers\Frontend\PropertyController::class, 'show'])->name('properties.show');

Route::get('/nha-dat-thue', [App\Http\Controllers\Frontend\PropertyController::class, 'indexThue'])->name('properties.indexThue');

Route::get('/dang-tin', [App\Http\Controllers\Frontend\PropertyController::class, 'createProperty'])->name('createProperty');
Route::post('/dang-tin', [App\Http\Controllers\Frontend\PropertyController::class, 'storeProperty'])->name('storeProperty');

Route::get('/danh-sach-tin', [App\Http\Controllers\Frontend\PropertyController::class, 'listProperties'])
    ->name('user.properties.index')
    ->middleware('auth');


Route::get('/tin-dang/{id}/edit', [App\Http\Controllers\Frontend\PropertyController::class, 'edit'])->name('user.properties.edit');
Route::put('/tin-dang/{id}', [App\Http\Controllers\Frontend\PropertyController::class, 'update'])->name('user.properties.update');

Route::delete('/properties/images/{id}', [App\Http\Controllers\Frontend\PropertyController::class, 'deleteImage'])
    ->name('properties.images.delete');


Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::post('/notifications/mark-as-read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return response()->json(['success' => true]);
})->middleware('auth')->name('notifications.markAsRead');

Route::prefix('admin')->middleware('check.admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // admin@gmail.com admin

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

    Route::get('/create-banner', [ProjectController::class, 'createBanner'])->name('admin.project.createBanner');
    Route::post('/projectBanner', [ProjectController::class, 'storeBanner'])->name('admin.project.storeBanner');
    Route::get('/banner', [ProjectController::class, 'indexBanner'])->name('admin.project.indexBanner');
    Route::get('/banner/{id}/edit', [ProjectController::class, 'editBanner'])->name('admin.project.editBanner');
    Route::put('/banner/{id}', [ProjectController::class, 'updateBanner'])->name('admin.project.updateBanner');
    Route::delete('/banner/{id}', [ProjectController::class, 'destroyBanner'])->name('admin.project.destroyBanner');


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

Route::get('/api/tinh', [LocationController::class, 'getProvinces']);
Route::get('/api/phuong/{districtId}', [LocationController::class, 'getWards']);

Broadcast::routes();

// php artisan config:clear
// php artisan route:clear
// php artisan cache:clear
// php artisan view:clear
