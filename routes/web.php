<?php

use Illuminate\Support\Facades\Route;

// Controller
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Login Controller Route
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth'])->name('auth')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/forgot-password', [LoginController::class, 'forgotPassword'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'sendToken'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [LoginController::class, 'resetPassword'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [LoginController::class, 'confirmToken'])->middleware('guest')->name('password.update');
// End Login Controller Route

// Dashboard Controller
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
// End Dashboard Controller
