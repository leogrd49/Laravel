@extends('layouts.app')

@section('titre')
    Modifier un Motif
@endsection

<div class="flex flex-col items-center justify-center min-h-screen py-6 px-4 bg-gray-100">
    <h2 class="text-center text-red-300 font-bold mb-6 text-2xl">Modifier un Motif</h2>

    <a href="{{ url('/') }}" class="mb-6 bg-red-300 text-red-800 font-bold py-2 px-4 rounded-lg border border-red-800 hover:bg-red-400">
        Retour
    </a>

    <form action="{{ route('motif.update', $motif->id) }}" method="POST" class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="libelle" class="block text-gray-700 text-sm font-bold mb-2">Nouveau Libellé</label>
            <input type="text" name="libelle" id="libelle" value="{{ old('libelle', $motif->libelle) }}" placeholder="Nom du Motif"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('libelle')
                <div class="text-red-500 text-xs italic mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-center">
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Modifier
            </button>
        </div>
    </form>
</div>
