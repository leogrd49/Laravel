<?php

namespace App\Http\Controllers;

use App\Http\Requests\MotifRequest;
use App\Models\Motif;
use Illuminate\Http\Request;

class MotifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\View\View
    {
        $motifs = Motif::all();

        return view(view: 'motif.index', data: compact('motifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\View\View
    {
        return view('motif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MotifRequest $request): \Illuminate\Http\RedirectResponse
    {
        $motif = new Motif();
        $motif->libelle = $request->libelle;
        $motif->save();

        return redirect('motif');
    }

    /**
     * Display the specified resource.
     */
    public function show(Motif $motif): \Illuminate\View\View
    {
        return view('motif.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motif $motif): \Illuminate\View\View
    {
        $motifs = Motif::where('id', $motif->id)->get();

        return view(view: 'motif.edit', data: compact('motif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motif $motif): \Illuminate\Http\RedirectResponse
    {
        $motif->libelle = $request->libelle;
        $motif->save();

        return redirect()->route('motif.index')->with('success', 'Motif updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motif $motif): \Illuminate\Http\RedirectResponse
    {
        $motif->delete();

        return redirect()->route('motif.index')->with('success', 'Motif deleted successfully.');
    }
}
