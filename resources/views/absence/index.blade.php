@extends('layouts.app')
@extends('layouts.absence')

@section('titre')
    Absences
@endsection

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-green-800">Absence List</h1>
        <a class="bg-green-300 w-min rounded-lg border border-green-800 p-2 font-bold text-center text-green-800 hover:bg-green-400"
            href="{{ url('/') }}">Back</a>
    </div>
    <h2 class="font-bold mb-3 text-right text-green-300">Nombre d'absences: {{ $absences->count() }}</h2>
    <div class="mb-3">
        <a class="bg-green-300 rounded-lg border border-green-800 p-2 font-bold text-green-800 hover:bg-green-400"
            href="{{ route('absence.create') }}">Create</a>
    </div>
    <ul class="space-y-4">
        @foreach ($absences as $absence)
            <li class="bg-green-50 p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="text-xl font-semibold">Absence Number: <span
                            class="text-green-700">{{ $absence->id }}</span></p>

                    <p class="text-xl font-semibold">Absence Reason: <span
                            class="text-green-700">{{ $absence->motif ? $absence->motif->libelle : 'N/A' }}</span></p>

                    <p class="text-xl font-semibold">User: <span
                            class="text-green-700">{{ $absence->user ? $absence->user->prenom . ' ' . $absence->user->nom : 'N/A' }}</span>
                    </p>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('absence.edit', $absence->id) }}" class="mr-2">
                        <box-icon name='edit' type='solid' color='#0bbc2c'></box-icon>
                    </a>
                    <form action="{{ route('absence.destroy', $absence->id) }}" method="POST" class="inline mt-3.5">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-green-500 hover:text-green-700 font-semibold"
                            onclick="confirmDelete(event)">
                            <box-icon name='trash' color='#0bbc2c'></box-icon>
                        </button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<script>
    function confirmDelete(event) {
        event.preventDefault();

        const form = event.target.closest('form');
        swal({
                title: "Es-tu sûr ?",
                text: "Une fois supprimé, ce motif ne pourra pas être récupéré !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    }
</script>
