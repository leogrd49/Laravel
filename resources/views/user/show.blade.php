@extends('layouts.app')
@section('titre')
User Details
@endsection

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-4xl font-bold mb-6 text-center text-blue-800">User Details</h1>

    <a class="bg-blue-300 rounded-lg border border-blue-800 p-2 font-bold text-blue-800 hover:bg-blue-400"
       href="{{ route('user.index') }}">Back</a>

    <div class="mb-6">
        <h2 class="text-2xl font-bold">User Information</h2>
        <p><strong>First Name:</strong> {{ $user->prenom }}</p>
        <p><strong>Last Name:</strong> {{ $user->nom }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>

    <div class="mt-6">
        <h2 class="text-2xl font-bold mb-3">Absences</h2>
        <ul class="space-y-4">
            @foreach ($absences as $absence)
                <li class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <p><strong>Motif:</strong> {{ $motifs->firstWhere('id', $absence->motif_id)->libelle }}</p>
                        <p><strong>Start Date:</strong> {{ $absence->date_debut }}</p>
                        <p><strong>End Date:</strong> {{ $absence->date_fin }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
