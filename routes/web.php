<?php

use App\Http\Controllers\Web\AuthPageController;
use App\Http\Controllers\Web\TaskPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthPageController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthPageController::class, 'login'])->name('login.attempt');

    Route::get('/register', [AuthPageController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthPageController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthPageController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthPageController::class, 'logout'])->name('logout');
    Route::get('/tasks', [TaskPageController::class, 'index'])->name('tasks.index');

    Route::post('/tasks/{task}/toggle', [TaskPageController::class, 'toggle'])->name('tasks.toggle');
    Route::post('/tasks', [TaskPageController::class, 'addTask'])->name('tasks.add');
    Route::delete('/tasks/{task}', [TaskPageController::class, 'deleteTask'])->name('tasks.delete');
});
