<?php

namespace App\Http\Controllers;

use App\Models\Motif;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        if (! $user || ! $user->admin) {
            abort(403, 'Unauthorized action.');
        }
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function create(): View
    {
        $user = Auth::user();
        if (! $user || ! $user->admin) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if (! $user || ! $user->admin) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'prenom' => $validated['prenom'],
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function show(User $user): View
    {
        $authUser = Auth::user();
        if (! $authUser || (! $authUser->admin && $authUser->id !== $user->id)) {
            abort(403, 'Unauthorized action.');
        }

        $absences = $user->absences;
        $motifs = Motif::all();

        return view('user.show', compact('user', 'absences', 'motifs'));
    }

    public function edit(User $user): View
    {
        $authUser = Auth::user();
        if (! $authUser || (! $authUser->admin && $authUser->id !== $user->id)) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $authUser = Auth::user();
        if (! $authUser || (! $authUser->admin && $authUser->id !== $user->id)) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'prenom' => $validated['prenom'],
            'nom' => $validated['nom'],
            'email' => $validated['email'],
        ]);

        if (isset($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $authUser = Auth::user();
        if (! $authUser || ! $authUser->admin) {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
