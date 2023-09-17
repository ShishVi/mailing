<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
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

Route::get('/', [AppController::class, 'mainPage'])->name('main.page');
Route::get('user/registration', [AuthController::class, 'registration'])->name('register.user');
Route::post('user/registration', [AuthController::class, 'store'])->name('store.user');
Route::get('user/login', [AuthController::class, 'login'])->name('login.user');
Route::post('user/login', [AuthController::class, 'authUser'])->name('auth.user');
Route::get('logout', [AuthController::class, 'logout'])->name('user.logout');