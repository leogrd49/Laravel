@extends('layouts.app')
@section('titre')
User List
@endsection

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-4xl font-bold mb-6 text-center text-red-800">User List</h1>
    <div class="mb-3">
        <a class="bg-red-300 w-min rounded-lg border border-red-800 p-2 font-bold text-center text-red-800 hover:bg-red-400"
            href="{{ url('/') }}">Back</a>
    </div>
    <ul class="space-y-4">
        @foreach ($users as $user)
            <li class="bg-red-50 p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="text-xl font-semibold">First Name: <span class="text-red-700">{{ $user->prenom }}</span></p>
                    <p class="text-xl font-semibold">Last Name: <span class="text-red-700">{{ $user->nom }}</span></p>
                </div>
                <div>
                    <a href="{{ route('user.show', $user->id) }}" class="text-red-500 hover:text-red-700 font-semibold">
                        View absences
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
</div>
