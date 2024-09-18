@extends('layout.app')
@section('titre')
Absences
@endsection

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-4xl font-bold mb-6 text-center text-red-800">Absence List</h1>
    <h2 class="font-bold mb-3 text-right text-red-300">Nombre d'absences: {{ $absences->count() }}</h2>
    <div class="mb-3">
        <a class="bg-red-300 w-min rounded-lg border border-red-800 p-2 font-bold text-center text-red-800 hover:bg-red-400"
            href="{{ url('/') }}">Back</a>
    </div>
    <div class="mt-6">
        <a class="bg-red-300 rounded-lg border border-red-800 p-2 font-bold text-right text-red-800 hover:bg-red-400"
            href="{{ route('absence.create') }}">Create</a>
    </div>
    <ul class="space-y-4">
        @foreach ($absences as $absence)
            <li class="bg-red-50 p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="text-xl font-semibold">Absence Number: <span class="text-red-700">{{ $absence->id }}</span></p>
                    <p class="text-xl font-semibold">Absence Reason: <span class="text-red-700">{{ $absence->motif->libelle }}</span></p>
                    <p class="text-xl font-semibold">User: <span class="text-red-700">{{ $absence->user->prenom }} {{ $absence->user->nom }}</span></p>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('absence.edit', $absence->id) }}" class="mr-2">
                        <box-icon name='edit' type='solid' color='#da1919'></box-icon>
                    </a>
                    <form action="{{ route('absence.destroy', $absence->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold" onclick="confirmDelete(event)">
                            <box-icon name='trash' color='#da1919'></box-icon>
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
