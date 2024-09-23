<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\MotifController;
use App\Http\Controllers\UserController;

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

    Route::middleware(['check.admin'])->group(function () {
        Route::resource('/user', UserController::class);
        Route::resource('/motif', MotifController::class);
    });
});

require __DIR__ . '/auth.php';
