@extends('layouts.app')

@section('titre', 'Liste des Absences')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Liste des Absences</h1>
        <a href="{{ url('/') }}" class="btn-secondary">Retour</a>
    </div>

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('absence.create') }}" class="btn-primary">Créer une absence</a>
        <p class="text-lg text-gray-600">Nombre d'absences: <span class="font-semibold">{{ $absences->count() }}</span></p>
    </div>

    <div class="space-y-4">
        @foreach ($absences as $absence)
            <div class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="text-lg"><span class="font-semibold">Absence N°:</span> {{ $absence->id }}</p>
                    <p class="text-lg"><span class="font-semibold">Motif:</span> {{ $absence->motif ? $absence->motif->libelle : 'N/A' }}</p>
                    <p class="text-lg"><span class="font-semibold">Utilisateur:</span> {{ $absence->user ? $absence->user->prenom . ' ' . $absence->user->nom : 'N/A' }}</p>
                    <p class="text-lg"><span class="font-semibold">Statut:</span> {{ $absence->status }}</p>
                </div>
                <div class="flex items-center">
                    @if (Auth::user()->admin || (Auth::id() == $absence->user_id && $absence->status != 'valide'))
                        <a href="{{ route('absence.edit', $absence->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                            <box-icon name='edit' type='solid' color='currentColor'></box-icon>
                        </a>
                        <form action="{{ route('absence.destroy', $absence->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette absence ?')">
                                <box-icon name='trash' color='currentColor'></box-icon>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .btn-primary {
        @apply bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300;
    }
    .btn-secondary {
        @apply bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300;
    }
</style>
@endsection
