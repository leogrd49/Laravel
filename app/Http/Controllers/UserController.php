<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;

class UserController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\View\View
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        User::create([
            'prenom' => $validated['prenom'],
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): \Illuminate\View\View
    {
        $user = User::findOrFail($id);
        $motifs = Motif::all();
        $absences = Absence::where('user_id', $user->id)->get();

        // // Débogage temporaire
        // dd($user, $absences, $motifs);

        return view('user.show', compact('user', 'absences', 'motifs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): \Illuminate\View\View
    {
        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        $user->update([
            'prenom' => $validated['prenom'],
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'password' => isset($validated['password']) ? bcrypt($validated['password']) : $user->password,
        ]);

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index');
    }
}
