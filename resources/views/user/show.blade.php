@extends('layouts.app')

@section('titre')
    Detail User
@endsection

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-4xl font-bold mb-6 text-center text-blue-800">{{ $users->prenom }} {{ $users->nom }}'s Absences</h1>
    <div class="mb-3">
        <a class="bg-blue-300 w-min rounded-lg border border-blue-800 p-2 font-bold text-center text-blue-800 hover:bg-blue-400"
            href="{{ url('/user') }}">Back</a>
    </div>
    <ul class="space-y-4">
        @forelse ($absences as $absence)
            <li class="bg-blue-50 p-5 rounded-lg shadow-md">
                <div class="mb-2">
                    <strong>Start Date:</strong>
                    <span class="text-blue-700">{{ $absence->date_debut }}</span>
                </div>
                <div class="mb-2">
                    <strong>End Date:</strong>
                    <span class="text-blue-700">{{ $absence->date_fin }}</span>
                </div>
                <div>
                    <strong>Reason:</strong>
                    <span class="text-blue-700">{{ $absence->motif ? $absence->motif->libelle : 'N/A' }}</span>
                </div>
            </li>
        @empty
            <div class="bg-blue-100 p-5 rounded-lg text-center">
                No absences recorded for this user
            </div>
        @endforelse
    </ul>
</div>
