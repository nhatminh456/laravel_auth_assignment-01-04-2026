<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    Route::patch('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.update-role');
    Route::resource('users', AdminUserController::class)->except(['show']);
});