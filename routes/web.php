<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Email\CreateController;
use App\Http\Controllers\Email\DestroyController;
use App\Http\Controllers\Email\EditController;
use App\Http\Controllers\Email\ImportController;
use App\Http\Controllers\Email\IndexController;
use App\Http\Controllers\Email\StoreController;
use App\Http\Controllers\Email\UpdateController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmailShippedController;
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

        Route::get('/', IndexController::class)->name('emails.index');
        Route::get('create', CreateController::class)->name('emails.create');
        Route::post('create', StoreController::class)->name('emails.store');
        Route::get('edit/{email}', EditController::class)->name('emails.edit');
        Route::put('edit/{email}', UpdateController::class)->name('emails.update');
        Route::delete('delete/{email}', DestroyController::class)->name('emails.destroy');
        Route::post('import-emails', ImportController::class)->name('emails.import');
    });

    Route::prefix('emails/shipped')->group(function(){

        Route::get('/', [EmailShippedController::class, 'create'])->name('emails.shipped.create');
        Route::post('/', [EmailShippedController::class, 'shippedEmail'])->name('emails.shipped.send');
    });
});
