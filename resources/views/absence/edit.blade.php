@extends('layouts.app')

@section('titre', __('absence.edit'))

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen py-6 px-4 bg-gray-100">
    <x-page-title class="text-green-300 mb-6">{{ __('absence.edit') }}</x-page-title>

    <x-back-button href="{{ url('/') }}" class="mb-6">
        {{ __('common.back') }}
    </x-back-button>

    <x-form-wrapper action="{{ route('absence.update', $absence->id) }}" method="POST">
        @csrf
        @method('PUT')

        <x-form-field name="user_id" label="{{ __('absence.user') }}">
            <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" {{ Auth::user()->admin ? '' : 'disabled' }}>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $absence->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->prenom }} {{ $user->nom }}
                    </option>
                @endforeach
            </select>
        </x-form-field>

        <x-form-field name="motif_id" label="{{ __('absence.reason') }}">
            <select name="motif_id" id="motif_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach ($motifs as $motif)
                    <option value="{{ $motif->id }}" {{ $absence->motif_id == $motif->id ? 'selected' : '' }}>
                        {{ $motif->libelle }}
                    </option>
                @endforeach
            </select>
        </x-form-field>

        <x-form-field name="date_debut" label="{{ __('absence.start_date') }}">
            <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut', $absence->date_debut) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </x-form-field>

        <x-form-field name="date_fin" label="{{ __('absence.end_date') }}">
            <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin', $absence->date_fin) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </x-form-field>

        @if (Auth::user()->admin)
            <x-form-field name="status" label="{{ __('absence.status') }}">
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="status" value="en_attente" {{ $absence->status == 'en_attente' ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('absence.status_pending') }}</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" class="form-radio" name="status" value="valide" {{ $absence->status == 'valide' ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('absence.status_validated') }}</span>
                    </label>
                </div>
            </x-form-field>
        @endif

        <x-submit-button>
            {{ __('common.edit') }}
        </x-submit-button>
    </x-form-wrapper>
</div>
@endsection
