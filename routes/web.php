<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/auth/login', [AuthController::class, 'loginPage'])->name('login.page');
    Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::get('/auth/register', [AuthController::class, 'registerPage'])->name('register.page');
    Route::post('/auth/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // schedule
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/schedule/{schedule}', [ScheduleController::class, 'show'])->name('schedule.show');
    Route::put('/schedule/{schedule}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

    Route::middleware('admin')->group(function () {
        // user
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    });
});
