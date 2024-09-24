@extends('layouts.app')

@section('titre', __('absence.edit'))

<div class="flex flex-col items-center justify-center min-h-screen py-6 px-4 bg-gray-100">
    <h2 class="text-center text-green-300 font-bold mb-6 text-2xl">{{ __('absence.edit') }}</h2>

    <a href="{{ url('/') }}"
        class="mb-6 bg-green-300 text-green-800 font-bold py-2 px-4 rounded-lg border border-green-800 hover:bg-green-400">
        {{ __('common.back') }}
    </a>

    <form action="{{ route('absence.update', $absence->id) }}" method="POST"
        class="w-full max-w-lg bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">{{ __('absence.user') }}</label>
            <select name="user_id" id="user_id"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                {{ Auth::user()->admin ? '' : 'disabled' }}>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $absence->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->prenom }} {{ $user->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="motif_id" class="block text-gray-700 text-sm font-bold mb-2">{{ __('absence.reason') }}</label>
            <select name="motif_id" id="motif_id"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach ($motifs as $motif)
                    <option value="{{ $motif->id }}" {{ $absence->motif_id == $motif->id ? 'selected' : '' }}>
                        {{ $motif->libelle }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="date_debut" class="block text-gray-700 text-sm font-bold mb-2">{{ __('absence.start_date') }}</label>
            <input type="date" name="date_debut" id="date_debut"
                value="{{ old('date_debut', $absence->date_debut) }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="date_fin" class="block text-gray-700 text-sm font-bold mb-2">{{ __('absence.end_date') }}</label>
            <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin', $absence->date_fin) }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        @if (Auth::user()->admin)
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('absence.status') }}</label>
                <div>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="status" value="en_attente"
                            {{ $absence->status == 'en_attente' ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('absence.status_pending') }}</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" class="form-radio" name="status" value="valide"
                            {{ $absence->status == 'valide' ? 'checked' : '' }}>
                        <span class="ml-2">{{ __('absence.status_validated') }}</span>
                    </label>
                </div>
            </div>
        @endif

        <div class="flex items-center justify-center">
            <button type="submit"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ __('common.edit') }}
            </button>
        </div>
    </form>
</div>
