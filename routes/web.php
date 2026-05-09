<?php

use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\TransportCompanyController;
use App\Http\Controllers\Admin\VoyageController as AdminVoyageController;
use App\Http\Controllers\Admin\VoyageImportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VoyageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/voyages', [VoyageController::class, 'index'])->name('voyages.index');
Route::get('/voyages/{voyage}/reserver', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/voyages/{voyage}/reserver', [ReservationController::class, 'store'])->name('reservations.store');

// Pages
Route::get('/touristique', [PageController::class, 'touristique'])->name('touristique');
Route::get('/messagerie', [PageController::class, 'messagerie'])->name('messagerie');
Route::get('/gare-inspiration', [PageController::class, 'gareInspiration'])->name('gare-inspiration');
Route::get('/qui-nous-sommes', [PageController::class, 'quiNousSommes'])->name('qui-nous-sommes');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('voyages', AdminVoyageController::class)->except(['show']);
    Route::resource('transport-companies', TransportCompanyController::class)->except(['show']);
    Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::post('/voyages/import', [VoyageImportController::class, 'store'])->name('voyages.import');
});

