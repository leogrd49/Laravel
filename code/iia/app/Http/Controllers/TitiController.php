<?php

namespace App\Http\Controllers;

use App\Models\Titi;
use Illuminate\Http\Request;

class TitiController extends Controller
{

    public function index()
    {
        return view('$titiController.index');
    }

    public function create()
    {
        return view('$titiController.create');

    }

    public function store(Request $request)
    {
        //
    }

    public function show(TitiController $titiController)
    {
        //
    }

    public function edit(TitiController $titiController)
    {
        return view('$titiController.edit');

    }

    public function update(Request $request, TitiController $titiController)
    {
        //
    }

    public function destroy(TitiController $titiController)
    {
        //
    }
}
