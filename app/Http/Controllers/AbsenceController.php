<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    /**
     *
     */
    public function index(): \Illuminate\View\View
    {
        $absences = Absence::all();
        return view('absence.index', data: compact('absences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\View\View
    {
        $users = User::all();
        $motifs = Motif::all();
        return view('absence.create', compact('users', 'motifs'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'date_debut' => 'required|date|before:date_fin',
            'date_fin' => 'required|date',
        ]);

        $absence = new Absence();
        $absence->user_id = $request->user_id;
        $absence->motif_id = $request->motif_id;
        $absence->date_debut = $request->date_debut;
        $absence->date_fin = $request->date_fin;
        $absence->save();

        return redirect()->route('absence.index')->with('success', 'Absence created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): \Illuminate\View\View
    {
        $absence = Absence::with(['user', 'motif'])->where('id', $id)->first();

        $motif = DB::table('motifs')
            ->join('absences', 'motifs.id', '=', 'absences.motif_id')
            ->where('absences.id', $id)
            ->select('motifs.Libelle')
            ->first();

        $user = DB::table('users')
            ->join('absences', 'users.id', '=', 'absences.user_id')
            ->where('absences.id', $id)
            ->select('users.prenom', 'users.nom')
            ->first();

        if (! $absence) {
            return view('errors.not_found', ['message' => 'Aucune absence ne porte ce numéro d\'identification.']);
        }

        return view('absence.show', [
            'absence' => $absence,
            'user' => $user,
            'motif' => $motif,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): \Illuminate\View\View
    {
        $absence = Absence::find($id);
        $users = User::all();
        $motifs = Motif::all();

        return view('absence.edit', compact('absence', 'users', 'motifs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'motif_id' => 'required|exists:motifs,id',
            'date_debut' => 'required|date|before:date_fin',
            'date_fin' => 'required|date',
        ]);

        $absence = Absence::find($id);
        $absence->user_id = $request->user_id;
        $absence->motif_id = $request->motif_id;
        $absence->date_debut = $request->date_debut;
        $absence->date_fin = $request->date_fin;
        $absence->save();

        return redirect()->route('absence.index')->with('success', 'Absence updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absence $absence): \Illuminate\Http\RedirectResponse
    {
        $absence->delete();
        return redirect('absence');
    }
}
