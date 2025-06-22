<?php

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

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/nha-dat-ban', function () {
    return view('pages.nha_dat_ban');
});

Route::get('/nha-dat-thue', function () {
    return view('pages.nha_dat_thue');
});

Route::get('/du-an', function () {
    return view('pages.du_an');
});
Route::get('/tin-tuc', function () {
    return view('pages.tin_tuc');
});
Route::get('/wiki', function () {
    return view('pages.wiki');
});
