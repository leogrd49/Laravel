@extends('layouts.app')

@section('titre', 'Accueil')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Bienvenue sur notre application</h1>

        @auth
            <div class="mb-6">
                <p class="text-lg text-gray-600">Utilisateur : <span class="font-semibold">{{ Auth::user()->prenom }}</span></p>
            </div>

            <div class="flex flex-wrap gap-4 mb-6">
                <a href="{{ route('absence.index') }}" class="btn-primary">
                    Absences
                </a>
                @if (Auth::user()->admin)
                    <a href="{{ route('user.index') }}" class="btn-secondary">
                        Utilisateurs
                    </a>
                    <a href="{{ route('motif.index') }}" class="btn-tertiary">
                        Motif
                    </a>
                @endif
            </div>
        @else
            <p class="text-lg text-gray-600 mb-4">Vous n'êtes pas connecté.</p>
            <div class="flex gap-4">
                <a href="{{ route('login') }}" class="btn-primary">Se connecter</a>
                <a href="{{ route('register') }}" class="btn-secondary">S'inscrire</a>
            </div>
        @endauth
    </div>

    <style>
        .btn-primary {
            @apply bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300;
        }

        .btn-secondary {
            @apply bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300;
        }

        .btn-tertiary {
            @apply bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-300;
        }
    </style>
@endsection
