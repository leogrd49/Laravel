<!DOCTYPE html>
<html>
<head>
    <title>List of Absences</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-100 min-h-screen p-10">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold mb-6 text-center text-red-800">Absence List</h1>
        <div class="mb-3">
            <a class="bg-red-300 w-min rounded-lg border border-red-800 p-2 font-bold text-center text-red-800 hover:bg-red-400" href="{{ url('/')}}">Back</a>
        </div>
        <ul class="space-y-4">
            @foreach ($absences as $absence)
                <li class="bg-red-50 p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <p class="text-xl font-semibold">Absence Number: <span class="text-red-700">{{ $absence->id }}</span></p>
                        <p class="text-xl font-semibold">Absence Reason: <span class="text-red-700">{{ $absence->motif->libelle }}</span></p>
                    </div>
                    <div>
                        <a href="{{ route('absence.show', $absence->id) }}" class="text-red-500 hover:text-red-700 font-semibold">
                            View Details
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
