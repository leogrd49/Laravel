@extends('layouts.app')
@extends('layouts.motif')

@section('titre')
    Motifs List
@endsection

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-red-800">Motifs List</h1>
        <a class="bg-red-300 rounded-lg border border-red-800 p-2 font-bold text-red-800 hover:bg-red-400"
            href="{{ url('/') }}">Back</a>
    </div>
    <div class="mt-6">
        <a class="bg-red-300 rounded-lg border border-red-800 p-2 font-bold text-center text-red-800 hover:bg-red-400"
            href="{{ route('motif.create') }}">Create</a>
    </div>
    <h2 class="font-bold mb-3 text-right text-red-300">Number of Motifs: {{ $motifs->count() }}</h2>
    <ul class="space-y-4">
        @foreach ($motifs as $motif)
            <li class="bg-red-50 p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="text-xl font-semibold">Motifs Number: <span
                            class="text-red-700">{{ $motif->id }}</span></p>
                    <p class="text-xl font-semibold">Motifs Reason: <span
                            class="text-red-700">{{ $motif->libelle }}</span></p>
                </div>
                <div class="flex items-center mt-3">
                    <a href="{{ route('motif.edit', $motif->id) }}" class="mr-2 mb-3.5">
                        <box-icon name='edit' type='solid' color='#da1919'></box-icon>
                    </a>
                    <form action="{{ route('motif.destroy', $motif->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold"
                            onclick="confirmDelete(event)">
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
