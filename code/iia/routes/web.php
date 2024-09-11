<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\AccueilController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('cool', function () {
    return "Cool !";
});

Route::get('test/profil', function () {
    return "Ceci est un test";
})->name("profil");



// TP 1

Route::get('1', function () {
    return "Je suis sur la Page 1";
})->name("Page 1");

Route::get('2', function () {
    return "Je suis sur la Page 2";
})->name("Page 2");

Route::get('3', function () {
    return "Je suis sur la Page 3";
})->name("Page 3");


// TP 2

Route::get('{numéro}', function ($numéro) {
    return "Je suis sur la page numéro " . $numéro;
})->name("");


// TP 3

Route::get('{a}/{b}', function ($a, $b) {
    return "Le resultat de $a x $b est " . $a * $b;
})
->where(['a' => '[0-9]+' , 'b' => '[0-9]+'])
->name("Calcul");

// TP 4

Route::get('/', [AccueilController::class, 'index']);

// TP 5

Route::resource('test', TestController::class);