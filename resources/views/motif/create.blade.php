@extends('layouts.app')

@section('titre')
    Créer un Motif
@endsection

<div class="flex flex-col items-center justify-center min-h-screen py-6 px-4 bg-gray-100">
    <h2 class="text-center text-red-300 font-bold mb-6 text-2xl">Créer un Motif</h2>

    <a href="{{ url('/') }}" class="mb-6 bg-red-300 text-red-800 font-bold py-2 px-4 rounded-lg border border-red-800 hover:bg-red-400">
        Retour
    </a>

    <form action="{{ route('motif.store') }}" method="POST" class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="libelle" class="block text-gray-700 text-sm font-bold mb-2">Label</label>
            <input type="text" name="libelle" id="libelle" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Label" value="{{ old('libelle') }}">
            @error('libelle')
                <div class="text-red-500 text-xs italic mb-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <span class="block text-gray-700 text-sm font-bold mb-2">Is Accessible?</span>
            <label class="inline-flex items-center mr-4">
                <input type="radio" name="is_accessible_salarie" value="1" class="form-radio" {{ old('is_accessible_salarie') == '1' ? 'checked' : '' }}>
                <span class="ml-2">Yes</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" name="is_accessible_salarie" value="0" class="form-radio" {{ old('is_accessible_salarie') == '0' ? 'checked' : '' }}>
                <span class="ml-2">No</span>
            </label>
            @error('is_accessible_salarie')
                <div class="text-red-500 text-xs italic mb-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-center">
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Créer
            </button>
        </div>
    </form>
</div>
