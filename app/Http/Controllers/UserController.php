<?php

namespace App\Http\Controllers;

use App\Models\Motif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        if (! Auth::user()->admin) {
            abort(403, 'Unauthorized action.');
        }
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        if (! Auth::user()->admin) {
            abort(403, 'Unauthorized action.');
        }
        return view('user.create');
    }

    public function store(Request $request)
    {
        if (! Auth::user()->admin) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        if (! Auth::user()->admin && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $absences = $user->absences;
        $motifs = Motif::all();
        return view('user.show', compact('user', 'absences', 'motifs'));
    }

    public function edit(User $user)
    {
        if (! Auth::user()->admin && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (! Auth::user()->admin && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (! Auth::user()->admin) {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
