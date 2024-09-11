<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccueilController extends Controller
{

    public function __construct()
    {
                
    }

    public function index()
    {
        return view('welcome');
    }
}
