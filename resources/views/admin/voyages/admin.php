<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VoyageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReservationController;

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('voyages', VoyageController::class);
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
});