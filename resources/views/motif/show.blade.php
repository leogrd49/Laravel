@extends('layout.app')

@section('titre')
Detail motif
@endsection

<div class="text-center">
    <h1 class="text-6xl mb-10 text-red-800">motif #{{ $motif->id }}</h1>
    <div class="mb-3">
        <a class="bg-red-300 w-min rounded-lg border border-red-800 p-2 font-bold text-center text-red-800 hover:bg-red-400"
            href="{{ url('/motif') }}">Back</a>
    </div>
    <div class="border border-red-800 max-w-xl p-5 mt-10 bg-white shadow-md rounded-lg">
        <div class="mb-4">
            <p><strong>User:</strong> {{ $user->prenom }} {{ $user->nom }}</p>
        </div>
        <div class="mb-4">
            <p><strong>Reason:</strong> {{ $motif->Libelle }}</p>
        </div>
        <div class="mb-4">
            <p><strong>Start Date:</strong> {{ $motif->date_debut }}</p>
        </div>
        <div>
            <p><strong>End Date:</strong> {{ $motif->date_fin }}</p>
        </div>
    </div>
</div>
