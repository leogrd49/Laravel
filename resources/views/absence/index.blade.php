@extends('layouts.app')

@section('titre', __('absenceslisttitle'))

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <x-page-title class="text-red-800">{{ __('absenceslisttitle') }}</x-page-title>
        <x-back-button href="{{ url('/') }}">{{ __('back') }}</x-back-button>
    </div>
    <div class="mb-6">
        <x-create-button href="{{ route('absence.create') }}">{{ __('createabsence') }}</x-create-button>
    </div>
    <x-item-count class="mb-4" :label="__('absencescount')" :count="$absences->count()" />
    <ul class="space-y-4">
        @foreach ($absences as $absence)
            <x-absence-list-item :absence="$absence">
                @if (Auth::user()->admin || (Auth::id() == $absence->user_id && $absence->status != 'valide'))
                    <x-action-button type="edit" :href="route('absence.edit', $absence->id)" />
                    <x-action-button type="delete" :href="route('absence.destroy', $absence->id)" />
                @endif
            </x-absence-list-item>
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
