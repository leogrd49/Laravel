@extends('layouts.app')
@section('titre')
users EDIT
@endsection

<h2 class="font-bold mb-3 text-center text-red-300">EDIT</h2>

<form action="{{ route('user.update', $user->id) }}" method="post">
    @csrf
    @method('put')
    <div class="mb-4">
        <label for="libelle" class="block text-gray-700 text-sm font-bold mb-2">Nouveau Libelle</label>
        <input type="text" name="libelle" id="libelle" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="user Name" value="{{ $user->libelle }}">
    </div>
    <div class="flex items-center justify-between">
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Editer
        </button>
    </div>
</form>
