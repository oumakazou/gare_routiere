<?php

use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\TransportCompanyController;
use App\Http\Controllers\Admin\VoyageController as AdminVoyageController;
use App\Http\Controllers\Admin\VoyageImportController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\LanguageController;

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'locale'])->group(function () {
    // Switch Language
    Route::get('lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/voyages', [VoyageController::class, 'index'])->name('voyages.index');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/voyages/{voyage}/reserver', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/voyages/{voyage}/reserver', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}/payment', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/reservations/{reservation}/payment', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/reservations/{reservation}/payment/success', [PaymentController::class, 'success'])->name('payments.success');

    Route::get('/touristique', [PageController::class, 'touristique'])->name('touristique');
    Route::get('/messagerie', [PageController::class, 'messagerie'])->name('messagerie');
    Route::post('/messagerie', [PageController::class, 'submitMessagerie'])->name('messagerie.submit');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
    Route::get('/gare-inspiration', [PageController::class, 'gareInspiration'])->name('gare-inspiration');
    Route::get('/qui-nous-sommes', [PageController::class, 'quiNousSommes'])->name('qui-nous-sommes');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});

// The authentication routes are handled by require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Admin dashboard
    Route::resource('voyages', AdminVoyageController::class)->except(['show']);
    Route::resource('transport-companies', TransportCompanyController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('reservations', AdminReservationController::class)->only(['index']);

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::post('/voyages/import', [VoyageImportController::class, 'store'])->name('voyages.import');
});
