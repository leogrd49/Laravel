@extends('layouts.app')

@section('titre', __('motifs.list_title'))

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-yellow-800">{{ __('motifs.list_title') }}</h1>
        <a class="bg-yellow-300 rounded-lg border border-yellow-800 p-2 font-bold text-yellow-800 hover:bg-yellow-400"
            href="{{ url('/') }}">{{ __('common.back') }}</a>
    </div>
    <div class="mb-6">
        <a class="bg-yellow-300 rounded-lg border border-yellow-800 p-2 font-bold text-center text-yellow-800 hover:bg-yellow-400"
            href="{{ route('motif.create') }}">{{ __('motifs.create') }}</a>
    </div>
    <p class="text-lg text-gray-600 mb-4">{{ __('motifs.count') }}: <span class="font-semibold">{{ $motifs->count() }}</span></p>
    <ul class="space-y-4">
        @foreach ($motifs as $motif)
            <li class="bg-yellow-50 p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="text-xl font-semibold">{{ __('motifs.number') }}: <span class="text-yellow-700">{{ $motif->id }}</span></p>
                    <p class="text-xl font-semibold">{{ __('motifs.label') }}: <span class="text-yellow-700">{{ $motif->libelle }}</span></p>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('motif.edit', $motif->id) }}" class="text-yellow-500 hover:text-yellow-700 mr-4 mb-3.5">
                        <box-icon name='edit' type='solid' color='#b7950b'></box-icon>
                    </a>
                    <form action="{{ route('motif.destroy', $motif->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-yellow-500 hover:text-yellow-700 font-semibold"
                            onclick="confirmDelete(event)">
                            <box-icon name='trash' color='#b7950b'></box-icon>
                        </button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(event) {
        event.preventDefault();

        const form = event.target.closest('form');
        swal({
                title: "{{ __('common.delete_confirm_title') }}",
                text: "{{ __('motifs.delete_confirm_text') }}",
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
@endpush
