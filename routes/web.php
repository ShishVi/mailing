<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
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

Route::middleware('auth')->group(function(){

    Route::prefix('emails')->group(function(){

        Route::get('/', [EmailController::class, 'index'])->name('index.emails');
        Route::get('create', [EmailController::class, 'create'])->name('create.emails');
        Route::post('create', [EmailController::class, 'store'])->name('store.emails');
        Route::get('edit/{id}', [EmailController::class, 'edit'])->name('edit.emails');
        Route::put('edit/{id}', [EmailController::class, 'update'])->name('update.emails');
        Route::delete('delete/{id}', [EmailController::class, 'destroy'])->name('delete.emails');
    });
});