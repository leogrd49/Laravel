<?php

namespace App\Http\Controllers;

use App\Mail\InfoMail;
use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AbsenceController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $user = Auth::user();
        if ($user->admin) {
            $absences = Absence::all();
        } else {
            $absences = $user->absences;
        }

        return view('absence.index', compact('absences'));
    }

    public function create(): \Illuminate\View\View
    {
        $user = Auth::user();
        $users = $user->admin ? User::all() : collect([$user]);  // Assure que $users est une collection même pour un seul utilisateur
        $motifs = Motif::all();

        return view('absence.create', compact('users', 'motifs'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'motif_id' => 'required|exists:motifs,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        if (! $user->admin && $data['user_id'] !== $user->id) {
            return redirect()->route('absence.index')->with('error', 'Vous ne pouvez pas créer une absence pour un autre utilisateur.');
        }

        $absence = Absence::create($data);
        $motif = Motif::find($data['motif_id']);
        $concernedUser = User::find($data['user_id']);

        if ($concernedUser instanceof User && $motif instanceof Motif) {
            $details = [
                'Utilisateur' => $concernedUser->prenom . ' ' . $concernedUser->nom,
                'Motif' => $motif->libelle,
                'Date de début' => $absence->date_debut,
                'Date de fin' => $absence->date_fin,
                'Statut' => $absence->status,
            ];

            Mail::to($user->email)->send(new InfoMail(
                'Nouvelle absence créée',
                'Une nouvelle absence a été créée.',
                $details
            ));

            $admins = User::where('admin', true)->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new InfoMail(
                    'Nouvelle absence créée',
                    "Une nouvelle absence a été créée par {$user->prenom} {$user->nom}.",
                    $details
                ));
            }
        }

        return redirect()->route('absence.index')->with('success', 'Absence créée avec succès.');
    }

    public function edit(Absence $absence): \Illuminate\View\View
    {
        $user = Auth::user();

        if (! $user->admin && ($absence->user_id !== $user->id || $absence->status === 'valide')) {
            return view('absence.index', ['error' => 'Vous ne pouvez pas modifier cette absence.']);
        }

        $users = $user->admin ? User::all() : collect([$user]);
        $motifs = Motif::all();

        return view('absence.edit', compact('absence', 'users', 'motifs'));
    }

    public function update(Request $request, Absence $absence): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        if (! $user->admin && ($absence->user_id !== $user->id || $absence->status === 'valide')) {
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
        $motif = Motif::find($data['motif_id']);
        $concernedUser = User::find($data['user_id']);

        if ($concernedUser instanceof User && $motif instanceof Motif) {
            $details = [
                'Utilisateur' => $concernedUser->prenom . ' ' . $concernedUser->nom,
                'Motif' => $motif->libelle,
                'Date de début' => $absence->date_debut,
                'Date de fin' => $absence->date_fin,
                'Statut' => $absence->status,
            ];

            if ($user->admin && $user->id !== $absence->user_id) {
                Mail::to($concernedUser->email)->send(new InfoMail(
                    'Votre absence a été modifiée',
                    'Votre absence a été mise à jour par un administrateur.',
                    $details
                ));
            }

            Mail::to($user->email)->send(new InfoMail(
                'Absence mise à jour',
                "L'absence a été mise à jour.",
                $details
            ));
        }

        return redirect()->route('absence.index')->with('success', 'Absence mise à jour avec succès.');
    }

    public function destroy(Absence $absence): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        if (! $user->admin && $absence->user_id !== $user->id) {
            return redirect()->route('absence.index')->with('error', 'Vous ne pouvez pas supprimer cette absence.');
        }

        $details = [
            'Utilisateur' => $absence->user->prenom . ' ' . $absence->user->nom,
            'Motif' => $absence->motif->libelle,
            'Date de début' => $absence->date_debut,
            'Date de fin' => $absence->date_fin,
            'Statut' => $absence->status,
        ];

        $absence->delete();

        Mail::to($user->email)->send(new InfoMail(
            'Absence supprimée',
            "L'absence a été supprimée.",
            $details
        ));

        return redirect()->route('absence.index')->with('success', 'Absence supprimée avec succès.');
    }
}
