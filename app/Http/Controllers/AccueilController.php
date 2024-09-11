<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AccueilController extends Controller
{
    public function __construct(){
        // abort(500); //renvoie une erreur 500
    }

    public function index(){
        return view('welcome');
    }
}
