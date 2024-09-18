@extends('layouts.app')
@section('titre')
Motifs EDIT
@endsection

<h2 class="font-bold mb-3 text-center text-red-300">EDIT</h2>

<a class="bg-red-300 rounded-lg border border-red-800 p-2 font-bold text-red-800 hover:bg-red-400"
href="{{ url('/') }}">Back</a>

<form action="{{ route('motif.update', $motif->id) }}" method="post">
    @csrf
    @method('put')
    <div class="mb-4">
        <label for="libelle" class="block text-gray-700 text-sm font-bold mb-2">Nouveau Libelle</label>
        <input type="text" name="libelle" id="libelle" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Motif Name" value="{{ $motif->libelle }}">
    </div>
    <div class="flex items-center justify-between">
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Editer
        </button>
    </div>
</form>
