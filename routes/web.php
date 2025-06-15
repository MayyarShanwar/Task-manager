<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::middleware('guest')->group(function () {
    Route::get('/signup', [UserController::class, 'home']);
    Route::post('/signup', [UserController::class, 'signup']);
    Route::get('/login', [UserController::class, 'loginView'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
});

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/',[TaskController::class,'index']);
    Route::delete('/logout',[UserController::class ,'logout']);
    Route::get('/task',[TaskController::class,'create']);
    Route::post('/task',[TaskController::class,'store']);
    Route::delete('/task/{task}',[TaskController::class,'destroy']);
    Route::get('/markAllAsRead',[TaskController::class,'markAllAsRead']);
    Route::get('/{filter}',[TaskController::class,'index'])->name('welcome');
});

Route::get('/verify', [EmailController::class,'verify']);
Route::get('/notice', [EmailController::class,'notice'])->name('verification.notice');
Route::get('/resend', [EmailController::class,'resend']);