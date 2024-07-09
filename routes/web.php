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
    return view('servidor');
});


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/kiosko', function () {
    return view('kiosko');
});
Route::get('/pago', function () {
    return view('pago');
});

