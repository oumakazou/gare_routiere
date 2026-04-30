<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\Admin\AutocarController as AdminAutocarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EquipementController as AdminEquipementController;
use App\Http\Controllers\Admin\OptionController as AdminOptionController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\SocieteController as AdminSocieteController;
use App\Http\Controllers\Admin\TypeVoyageController as AdminTypeVoyageController;
use App\Http\Controllers\Admin\VilleController as AdminVilleController;
use App\Http\Controllers\Admin\VoyageController as AdminVoyageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/voyages', [VoyageController::class, 'index'])->name('voyages.index');
Route::get('/voyages/{voyage}', [VoyageController::class, 'show'])->name('voyages.show');
Route::get('/voyages/{voyage}/reserve', [ReservationController::class, 'create'])->name('reservations.create')->middleware('auth');
Route::post('/voyages/{voyage}/reserve', [ReservationController::class, 'store'])->name('reservations.store')->middleware('auth');
Route::get('/mes-reservations', [ReservationController::class, 'index'])->name('reservations.index')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('villes', AdminVilleController::class)->except(['show']);
    Route::resource('societes', AdminSocieteController::class)->except(['show']);
    Route::resource('autocars', AdminAutocarController::class)->except(['show']);
    Route::resource('equipements', AdminEquipementController::class)->except(['show']);
    Route::resource('options', AdminOptionController::class)->except(['show']);
    Route::resource('type-voyages', AdminTypeVoyageController::class)->parameters(['type-voyages' => 'type_voyage'])->except(['show']);
    Route::resource('voyages', AdminVoyageController::class)->except(['show']);
    Route::resource('reservations', AdminReservationController::class)->except(['show']);
});

require __DIR__.'/auth.php';
