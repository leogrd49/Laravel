@extends('layouts.app')

@section('titre', __('absence.detail'))

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen py-6 px-4 bg-gray-100">
    <x-page-title class="text-6xl mb-10 text-green-800">
        {{ __('absence.absence_number', ['id' => $absence->id]) }}
    </x-page-title>

    <x-back-button href="{{ url('/absence') }}" class="mb-6">
        {{ __('common.back') }}
    </x-back-button>

    <div class="border border-green-800 max-w-xl p-5 mt-10 bg-white shadow-md rounded-lg">
        <x-item-detail label="{{ __('absence.user') }}">
            {{ $user->prenom }} {{ $user->nom }}
        </x-item-detail>

        <x-item-detail label="{{ __('absence.reason') }}">
            {{ $motif->Libelle }}
        </x-item-detail>

        <x-item-detail label="{{ __('absence.start_date') }}">
            {{ $absence->date_debut }}
        </x-item-detail>

        <x-item-detail label="{{ __('absence.end_date') }}">
            {{ $absence->date_fin }}
        </x-item-detail>
    </div>
</div>
@endsection
