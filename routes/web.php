<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UpVoteController;
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
        Route::get('/features/create', [FeatureController::class, 'create'])->name('features.create');
        Route::get('/features/{feature}', [FeatureController::class, 'show'])->name('features.show');
        Route::get('/features/{feature}/edit', [FeatureController::class, 'edit'])->name('features.edit');
        Route::post('/features', [FeatureController::class, 'store'])->name('features.store');
        Route::put('/features/{feature}', [FeatureController::class, 'update'])->name('features.update');
        Route::delete('/features/{feature}', [FeatureController::class, 'destroy'])->name('features.destroy');
    });

    Route::middleware(['verified'])->group(function(){
        Route::post('feature/{feature}/upvote',[UpVoteController::class,'store'])->name('upvote.store');
        Route::delete('/upvote{feature}',[UpVoteController::class,'destroy'])->name('upvote.destroy');
    });

    Route::middleware(['verified'])->group(function(){
        Route::post('feature/{feature}/comments',[CommentController::class,'store'])->name('comment.store');
        Route::delete('/comment{comment}',[CommentController::class,'destroy'])->name('comments.destroy');
    });

});

require __DIR__.'/auth.php';
