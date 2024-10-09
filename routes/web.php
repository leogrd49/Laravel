<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MotifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('user', UserController::class);
});

Route::post('/change-language', [LanguageController::class, 'change'])->name('change.language');

Route::middleware(['set.language'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/welcome', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return redirect('/');
    })->middleware(['auth'])->name('dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::resource('/absence', AbsenceController::class);

        Route::middleware(['admin'])->group(function () {
            Route::resource('/user', UserController::class);
            Route::resource('/motif', MotifController::class);
        });

        Route::get('/user/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/user/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
