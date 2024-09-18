<!DOCTYPE html>
<html>
<head>
    <title>Absence Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-red-100">
    <div class="text-center">
        <h1 class="text-6xl mb-10 text-red-800">Absence #{{ $absence->id }}</h1>
        <div class="mb-3">
            <a class="bg-red-300 w-min rounded-lg border border-red-800 p-2 font-bold text-center text-red-800 hover:bg-red-400" href="{{ url('/absence')}}">Back</a>
        </div>
        <div class="border border-red-800 max-w-xl p-5 mt-10 bg-white shadow-md rounded-lg">
            <div class="mb-4">
                <p><strong>User:</strong> {{ $user->prenom }} {{ $user->nom }}</p>
            </div>
            <div class="mb-4">
                <p><strong>Reason:</strong> {{ $motif->Libelle }}</p>
            </div>
            <div class="mb-4">
                <p><strong>Start Date:</strong> {{ $absence->date_debut }}</p>
            </div>
            <div>
                <p><strong>End Date:</strong> {{ $absence->date_fin }}</p>
            </div>
        </div>
    </div>
</body>
</html>
