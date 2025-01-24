<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReminderController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('reminders', ReminderController::class);
