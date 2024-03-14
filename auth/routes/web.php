<?php

use App\Http\Controllers\Auth\ChangePassword\ForgotPasswordController;
use App\Http\Controllers\Auth\ChangePassword\ResetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MainController;
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

Route::get('/main', [MainController::class,'index'])->name('main');
Route::middleware('guest') ->group(function (){
    Route::get('/register', [RegisterController::class,'create'])->name('register');
    Route::post('/register', [RegisterController::class,'store']);
    Route::get('/login', [LoginController::class,'create'])->name('login');
    Route::post('/login', [LoginController::class,'store']);
    Route::get('/forgot-password',[ForgotPasswordController::class,'create'])->name('password.request');
    Route::post('/forgot-password',[ForgotPasswordController::class,'store'])->name('forgot.password');
    Route::get('/reset-password',[ResetPasswordController::class,'create'])->name('password.reset');
    Route::post('/reset-password',[ResetPasswordController::class,'store'])->name('password.update');
});
