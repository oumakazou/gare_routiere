use App\Http\Controllers\VoyageController;
use App\Http\Controllers\Admin\AdminController;

// Client Routes
Route::get('/voyages', [VoyageController::class, 'index'])->name('voyages.index');
Route::post('/voyages/{voyage}/reserve', [VoyageController::class, 'reserve'])->name('voyages.reserve');
Route::get('/touristiques', function () { return view('touristiques'); })->name('touristiques');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('voyages', App\Http\Controllers\Admin\VoyageAdminController::class);
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('reservations');
});