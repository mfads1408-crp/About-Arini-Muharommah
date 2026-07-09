<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/migrate-db-temp', function() {
    try {
        if (!\Illuminate\Support\Facades\Schema::hasColumn('users', 'role')) {
            \Illuminate\Support\Facades\Schema::table('users', function ($table) {
                $table->string('role')->default('user');
            });
            return 'Berhasil: Kolom role telah ditambahkan ke database!';
        }
        return 'Berhasil: Kolom role sudah ada di database.';
    } catch (\Exception $e) {
        return 'Gagal: ' . $e->getMessage();
    }
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('journals', \App\Http\Controllers\JournalController::class);
    Route::resource('periods', \App\Http\Controllers\PeriodTrackerController::class);
    Route::resource('preferences', \App\Http\Controllers\PreferenceController::class);
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users/{user}/journals', [\App\Http\Controllers\AdminController::class, 'showUserJournals'])->name('users.journals');
});

require __DIR__.'/auth.php';
