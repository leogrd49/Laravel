@extends('layouts.app')

@section('titre')
    Créer une Absence
@endsection

<div class="flex flex-col items-center justify-center min-h-screen py-6 px-4 bg-gray-100">
    <h2 class="text-center text-green-300 font-bold mb-6 text-2xl">Créer une Absence</h2>

    <a href="{{ url('/') }}" class="mb-6 bg-green-300 text-green-800 font-bold py-2 px-4 rounded-lg border border-green-800 hover:bg-green-400">
        Retour
    </a>

    <form action="{{ route('absence.store') }}" method="POST" class="w-full max-w-lg bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Utilisateur</label>
            <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Sélectionner un utilisateur</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->prenom }} {{ $user->nom }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="motif_id" class="block text-gray-700 text-sm font-bold mb-2">Motif</label>
            <select name="motif_id" id="motif_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Sélectionner un motif</option>
                @foreach ($motifs as $motif)
                    <option value="{{ $motif->id }}" {{ old('motif_id') == $motif->id ? 'selected' : '' }}>
                        {{ $motif->libelle }}
                    </option>
                @endforeach
            </select>
            @error('motif_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="date_debut" class="block text-gray-700 text-sm font-bold mb-2">Date de début</label>
            <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('date_debut')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="date_fin" class="block text-gray-700 text-sm font-bold mb-2">Date de fin</label>
            <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('date_fin')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-center">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Créer
            </button>
        </div>
    </form>
</div>
