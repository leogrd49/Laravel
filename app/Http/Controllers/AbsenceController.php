<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\User;
use App\Models\Motif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->admin) {
            $absences = Absence::all();
        } else {
            $absences = $user->absences;
        }
        return view('absence.index', compact('absences'));
    }

    public function create()
    {
        $user = Auth::user();
        $users = $user->admin ? User::all() : [$user];
        $motifs = Motif::all();
        return view('absence.create', compact('users', 'motifs'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'motif_id' => 'required|exists:motifs,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        if (!$user->admin && $data['user_id'] != $user->id) {
            return redirect()->route('absence.index')->with('error', 'Vous ne pouvez pas créer une absence pour un autre utilisateur.');
        }

        Absence::create($data);
        return redirect()->route('absence.index')->with('success', 'Absence créée avec succès.');
    }

    public function edit(Absence $absence)
    {
        $user = Auth::user();
        if (!$user->admin && ($absence->user_id != $user->id || $absence->status == 'valide')) {
            return redirect()->route('absence.index')->with('error', 'Vous ne pouvez pas modifier cette absence.');
        }

        $users = $user->admin ? User::all() : [$user];
        $motifs = Motif::all();
        return view('absence.edit', compact('absence', 'users', 'motifs'));
    }

    public function update(Request $request, Absence $absence)
    {
        $user = Auth::user();
        if (!$user->admin && ($absence->user_id != $user->id || $absence->status == 'valide')) {
            return redirect()->route('absence.index')->with('error', 'Vous ne pouvez pas modifier cette absence.');
        }

        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'motif_id' => 'required|exists:motifs,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        if ($user->admin) {
            $data['status'] = $request->input('status', 'en_attente');
        }

        $absence->update($data);
        return redirect()->route('absence.index')->with('success', 'Absence mise à jour avec succès.');
    }

    public function destroy(Absence $absence)
    {
        $user = Auth::user();
        if (!$user->admin && $absence->user_id != $user->id) {
            return redirect()->route('absence.index')->with('error', 'Vous ne pouvez pas supprimer cette absence.');
        }

        $absence->delete();
        return redirect()->route('absence.index')->with('success', 'Absence supprimée avec succès.');
    }
}
