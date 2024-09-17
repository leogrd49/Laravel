<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('showAbsence/{id}', [AbsenceController::class, 'show'])
->name('showAbsence');

Route::get('showAbsenceOfAUser/{id}', [UserController::class, 'show'])
->name('showAbsenceOfAUser');

