<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotifRequest;
use App\Models\Motif;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class MotifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $motifs = Cache::remember('motifs', 3500, function () {
            return Motif::all();
        });

        return view('motif.index', compact('motifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('motif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MotifRequest $request): RedirectResponse
    {
        $libelle = $request->input('libelle');
        if (! is_string($libelle)) {
            throw new \InvalidArgumentException('Libelle must be a string');
        }

        $motif = new Motif();
        $motif->libelle = $libelle;
        $motif->is_accessible_salarie = $request->input('is-accessible-salarie') === '1';
        $motif->save();

        Cache::forget('motifs');

        return redirect()->route('motif.index')->with('success', 'Motif created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Motif $motif): View
    {
        return view('motif.show', compact('motif'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motif $motif): View
    {
        return view('motif.edit', compact('motif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MotifRequest $request, Motif $motif): RedirectResponse
    {
        $libelle = $request->input('libelle');
        if (! is_string($libelle)) {
            throw new \InvalidArgumentException('Libelle must be a string');
        }

        $motif->libelle = $libelle;
        $motif->is_accessible_salarie = $request->input('is-accessible-salarie') === '1';
        $motif->save();

        Cache::forget('motifs');

        return redirect()->route('motif.index')->with('success', 'Motif updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motif $motif): RedirectResponse
    {
        $motif->delete();
        Cache::forget('motifs');

        return redirect()->route('motif.index')->with('success', 'Motif deleted successfully.');
    }
}
