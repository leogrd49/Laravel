@extends('layouts.app')

@section('titre', __('users.list_title'))

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-blue-800">{{ __('users.list_title') }}</h1>
        <a class="bg-blue-300 rounded-lg border border-blue-800 p-2 font-bold text-blue-800 hover:bg-blue-400"
            href="{{ url('/') }}">{{ __('common.back') }}</a>
    </div>
    <div class="mb-6">
        <a class="bg-blue-300 rounded-lg border border-blue-800 p-2 font-bold text-center text-blue-800 hover:bg-blue-400"
            href="{{ route('user.create') }}">{{ __('users.create') }}</a>
    </div>
    <p class="text-lg text-gray-600 mb-4">{{ __('users.count') }}: <span class="font-semibold">{{ $users->count() }}</span></p>
    <ul class="space-y-4">
        @foreach ($users as $user)
            <li class="bg-blue-50 p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="text-xl font-semibold">{{ __('users.firstname') }}: <span class="text-blue-700">{{ $user->prenom }}</span></p>
                    <p class="text-xl font-semibold">{{ __('users.lastname') }}: <span class="text-blue-700">{{ $user->nom }}</span></p>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('user.show', $user->id) }}"
                        class="text-blue-500 hover:text-blue-700 font-semibold mr-4 mb-3.5">
                        <box-icon name='spreadsheet' color='#0000FF' class="mt-3.5"></box-icon>
                    </a>
                    <a href="{{ route('user.edit', $user->id) }}"
                        class="text-blue-500 hover:text-blue-700 font-semibold mr-4 mb-3.5">
                        <box-icon name='edit' type='solid' color='#0000FF' class="mt-3.5"></box-icon>
                    </a>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold"
                            onclick="confirmDelete(event)">
                            <box-icon name='trash' color='#0000FF'></box-icon>
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
                text: "{{ __('users.delete_confirm_text') }}",
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
