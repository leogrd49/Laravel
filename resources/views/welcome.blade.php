@extends('layouts.app')

@section('titre', __('common.home'))

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-green-800">{{ __('common.welcome') }}</h1>
    </div>

    @auth
        <div class="mb-6">
            <p class="text-xl font-semibold">{{ __('common.logged_in_as') }}: <span class="text-green-700">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</span></p>
        </div>

        {{-- TEST COMPOSANT  --}}
        {{-- <x-inputs.text property='libelle' default="" label="oui"/> --}}

        <div class="space-y-4">
            <a href="{{ route('absence.index') }}" class="bg-red-300 rounded-lg border border-red-800 p-4 flex justify-between items-center hover:bg-red-400 transition duration-300">
                <span class="text-xl font-semibold text-red-800">{{ __('common.absences') }}</span>
                <box-icon name='right-arrow-alt' color='#9B2C2C'></box-icon>
            </a>

            @if (Auth::user()->admin)
                <a href="{{ route('user.index') }}" class="bg-blue-300 rounded-lg border border-blue-800 p-4 flex justify-between items-center hover:bg-blue-400 transition duration-300">
                    <span class="text-xl font-semibold text-blue-800">{{ __('common.users') }}</span>
                    <box-icon name='right-arrow-alt' color='#2C5282'></box-icon>
                </a>

                <a href="{{ route('motif.index') }}" class="bg-yellow-300 rounded-lg border border-yellow-800 p-4 flex justify-between items-center hover:bg-yellow-400 transition duration-300">
                    <span class="text-xl font-semibold text-yellow-800">{{ __('common.reasons') }}</span>
                    <box-icon name='right-arrow-alt' color='#975A16'></box-icon>
                </a>
            @endif
        </div>
    @else
        <div class="bg-gray-100 p-6 rounded-lg mb-6">
            <p class="text-xl text-gray-700 mb-4">{{ __('common.not_logged_in') }}</p>
            <div class="flex gap-4">
                <a href="{{ route('login') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 text-lg font-semibold">
                    {{ __('common.login') }}
                </a>
                <a href="{{ route('register') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300 text-lg font-semibold">
                    {{ __('common.register') }}
                </a>
            </div>
        </div>
    @endauth
</div>
@endsection
