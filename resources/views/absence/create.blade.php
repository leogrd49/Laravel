@extends('layouts.app')

@section('titre', __('absence.create'))

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen py-6 px-4 bg-gray-100">
    <x-page-title class="text-green-300 mb-6">{{ __('absence.create') }}</x-page-title>

    <x-back-button href="{{ url('/') }}" class="mb-6">
        {{ __('common.back') }}
    </x-back-button>

    <x-form-wrapper action="{{ route('absence.store') }}" method="POST">
        @csrf

        <x-form-field name="user_id" label="{{ __('absence.user') }}">
            <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">{{ __('absence.select_user') }}</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->prenom }} {{ $user->nom }}
                    </option>
                @endforeach
            </select>
        </x-form-field>

        <x-form-field name="motif_id" label="{{ __('absence.reason') }}">
            <select name="motif_id" id="motif_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">{{ __('absence.select_reason') }}</option>
                @foreach ($motifs as $motif)
                    <option value="{{ $motif->id }}" {{ old('motif_id') == $motif->id ? 'selected' : '' }}>
                        {{ $motif->libelle }}
                    </option>
                @endforeach
            </select>
        </x-form-field>

        <x-form-field name="date_debut" label="{{ __('absence.start_date') }}">
            <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </x-form-field>

        <x-form-field name="date_fin" label="{{ __('absence.end_date') }}">
            <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </x-form-field>

        <x-submit-button>
            {{ __('common.create') }}
        </x-submit-button>
    </x-form-wrapper>
</div>
@endsection
