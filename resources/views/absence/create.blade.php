@extends('layout.app')
@section('titre')
    absences Create
@endsection

<h2 class="font-bold mb-3 text-center text-red-300">CREATE</h2>

<a class="bg-red-300 rounded-lg border border-red-800 p-2 font-bold text-red-800 hover:bg-red-400"
href="{{ url('/') }}">Back</a>

<form action="{{ route('absence.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">User</label>
        <select name="user_id" id="user_id"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->prenom }} {{ $user->nom }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label for="motif_id" class="block text-gray-700 text-sm font-bold mb-2">Motif</label>
        <select name="motif_id" id="motif_id"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @foreach ($motifs as $motif)
                <option value="{{ $motif->id }}">{{ $motif->libelle }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label for="date_debut" class="block text-gray-700 text-sm font-bold mb-2">Start Date</label>
        <input type="date" name="date_debut" id="date_debut"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    @error('date_debut')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
    <div class="mb-4">
        <label for="date_fin" class="block text-gray-700 text-sm font-bold mb-2">End Date</label>
        <input type="date" name="date_fin" id="date_fin"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="flex items-center justify-between">
        <button type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Create
        </button>
    </div>
</form>
