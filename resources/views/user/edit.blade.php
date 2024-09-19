@extends('layouts.app')
@section('titre')
User Edit
@endsection

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="font-bold mb-3 text-center text-blue-300">EDIT</h2>

    <a class="bg-blue-300 rounded-lg border border-blue-800 p-2 font-bold text-blue-800 hover:bg-blue-400"
       href="{{ route('user.index') }}">Back</a>

    <!-- Afficher les erreurs de validation -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input.</span>
            <ul class="mt-3 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="prenom" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
            <input type="text" name="prenom" id="prenom" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="First Name" value="{{ old('prenom', $user->prenom) }}">
        </div>
        <div class="mb-4">
            <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
            <input type="text" name="nom" id="nom" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Last Name" value="{{ old('nom', $user->nom) }}">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Email" value="{{ old('email', $user->email) }}">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Password">
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Confirm Password">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update
            </button>
        </div>
    </form>
</div>
