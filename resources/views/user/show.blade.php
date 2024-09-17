<!DOCTYPE html>
<html>
<head>
    <title>Absences de l'Utilisateur</title>
</head>
<body>
    <h1>Absences de {{ $users->prenom }}</h1>

    <ul>
        @forelse ($absences as $absence)
            <li>
                Date de début : {{ $absence->date_debut }}
                Date de fin : {{ $absence->date_fin }}
                Motif : {{ $absence->motif->libelle }}
            </li>
            @empty{{__('Aucune absence rescencée pour cet utilisateur')}}
        @endforelse
    </ul>
</body>
</html>
