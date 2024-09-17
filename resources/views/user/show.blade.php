<!DOCTYPE html>
<html>
<head>
    <title>Absences de l'Utilisateur</title>
</head>
<body>
    <h1>Absences</h1>

    <ul>
        @foreach ($absences as $absence)
            <li>
                Date de début : {{ $absence->date_debut }}
                Date de fin : {{ $absence->date_fin }}
                Motif ID : {{ $absence->motif_id }}
            </li>
        @endforeach
    </ul>
</body>
</html>
