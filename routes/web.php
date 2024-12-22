<?php

use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/dashboard');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['verified'])->group(function () {
        Route::get('/features', [FeatureController::class, 'index'])->name('features.index');
        Route::get('/features/{feature}', [FeatureController::class, 'show'])->name('features.show');
        Route::post('/features', [FeatureController::class, 'store'])->name('features.store');
        Route::patch('/features/{feature}', [FeatureController::class, 'update'])->name('features.update');
        Route::delete('/features/{feature}', [FeatureController::class, 'destroy'])->name('features.destroy');
    });
});

require __DIR__.'/auth.php';
