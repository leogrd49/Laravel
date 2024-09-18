@extends('layout.app')
@section('titre')
Motifs List
@endsection

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-4xl font-bold mb-6 text-center text-red-800">Motifs List</h1>
    <h2 class="font-bold mb-3 text-right text-red-300">Nombre d'Motifs: {{ $motifs->count() }}</h2>
    <div class="mb-3">
        <a class="bg-red-300 w-min rounded-lg border border-red-800 p-2 font-bold text-center text-red-800 hover:bg-red-400"
            href="{{ url('/') }}">Back</a>
    </div>
    <ul class="space-y-4">
        @foreach ($motifs as $motif)
            <li class="bg-red-50 p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="text-xl font-semibold">Motifs Number: <span class="text-red-700">{{ $motif->id }}</span>
                    </p>
                    <p class="text-xl font-semibold">Motifs Reason: <span
                            class="text-red-700">{{ $motif->libelle }}</span></p>
                </div>
                <div>
                    <a href="{{ route('motif.show', $motif->id) }}"
                        class="text-red-500 hover:text-red-700 font-semibold">
                        View Details
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
</div>
