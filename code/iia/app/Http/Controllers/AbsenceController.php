<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupération de la ligne de la table absence avec l'id correspondant (Eloquent)
        $absence = Absence::with([
            'user', 'motif'
        ])->findOrFail($id);


        // Renvoyer la réponse en JSON avec les informations de l'absence et ses relations
        return response()->json([
            'id' => $absence->id,
            'user' => [
                'id' => $absence->user->id,
                'name' => $absence->user->name,
                'email' => $absence->user->email,
            ],
            'motif' => [
                'id' => $absence->motif->id,
                'description' => $absence->motif->description,
            ],
            'start_date' => $absence->start_date,
            'end_date' => $absence->end_date,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absence $absence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absence $absence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absence $absence)
    {
        //
    }
}
