<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{

    public function index()
    {
        return view('$absence.index');
    }

    public function create()
    {
        return view('$absence.create');

    }

    public function store(Request $request)
    {
        //
    }

    public function show(Absence $absence)
    {
        //
    }

    public function edit(Absence $absence)
    {
        return view('$absence.edit');

    }

    public function update(Request $request, Absence $absence)
    {
        //
    }

    public function destroy(Absence $absence)
    {
        //
    }
}
