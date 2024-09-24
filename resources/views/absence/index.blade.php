@extends('layouts.app')

@section('titre', __('absenceslisttitle'))

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-red-800">{{ __('absenceslisttitle') }}</h1>
        <a class="bg-red-300 rounded-lg border border-red-800 p-2 font-bold text-red-800 hover:bg-red-400"
            href="{{ url('/') }}">{{ __('back') }}</a>
    </div>
    <div class="mb-6">
        <a class="bg-red-300 rounded-lg border border-red-800 p-2 font-bold text-center text-red-800 hover:bg-red-400"
            href="{{ route('absence.create') }}">{{ __('createabsence') }}</a>
    </div>
    <p class="text-lg text-gray-600 mb-4">{{ __('absencescount') }}: <span class="font-semibold">{{ $absences->count() }}</span></p>
    <ul class="space-y-4">
        @foreach ($absences as $absence)
            <li class="bg-red-50 p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="text-xl font-semibold">{{ __('absencenumber') }}: <span class="text-red-700">{{ $absence->id }}</span></p>
                    <p class="text-xl font-semibold">{{ __('absencereason') }}: <span class="text-red-700">{{ $absence->motif ? $absence->motif->libelle : __('na') }}</span></p>
                    <p class="text-xl font-semibold">{{ __('absenceuser') }}: <span class="text-red-700">{{ $absence->user ? $absence->user->prenom . ' ' . $absence->user->nom : __('na') }}</span></p>
                    <p class="text-xl font-semibold">{{ __('absencestatus') }}: <span class="text-red-700">{{ $absence->status }}</span></p>
                </div>
                <div class="flex items-center">
                    @if (Auth::user()->admin || (Auth::id() == $absence->user_id && $absence->status != 'valide'))
                        <a href="{{ route('absence.edit', $absence->id) }}" class="text-red-500 hover:text-red-700 mr-4 mb-3.5">
                            <box-icon name='edit' type='solid' color='#FF0000' class="mt-3.5"></box-icon>
                        </a>
                        <form action="{{ route('absence.destroy', $absence->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-semibold"
                                onclick="confirmDelete(event)">
                                <box-icon name='trash' color='#FF0000'></box-icon>
                            </button>
                        </form>
                    @endif
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
                title: "{{ __('deleteconfirmtitle') }}",
                text: "{{ __('deleteconfirmtext') }}",
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
