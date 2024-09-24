@extends('layouts.app')

@section('titre', __('absence.detail'))

<div class="text-center">
    <h1 class="text-6xl mb-10 text-green-800">{{ __('absence.absence_number', ['id' => $absence->id]) }}</h1>
    <div class="mb-3">
        <a class="bg-green-300 w-min rounded-lg border border-green-800 p-2 font-bold text-center text-green-800 hover:bg-green-400"
            href="{{ url('/absence') }}">{{ __('common.back') }}</a>
    </div>
    <div class="border border-green-800 max-w-xl p-5 mt-10 bg-white shadow-md rounded-lg">
        <div class="mb-4">
            <p><strong>{{ __('absence.user') }}:</strong> {{ $user->prenom }} {{ $user->nom }}</p>
        </div>
        <div class="mb-4">
            <p><strong>{{ __('absence.reason') }}:</strong> {{ $motif->Libelle }}</p>
        </div>
        <div class="mb-4">
            <p><strong>{{ __('absence.start_date') }}:</strong> {{ $absence->date_debut }}</p>
        </div>
        <div>
            <p><strong>{{ __('absence.end_date') }}:</strong> {{ $absence->date_fin }}</p>
        </div>
    </div>
</div>
