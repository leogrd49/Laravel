<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1>Utilisateurs</h1>

    <ul>
        @forelse ($users as $user)
            <li class="mt-2">
                Prénom : {{ $user->prenom }}
                nom : {{ $user->nom }}
                <a href="{{route('user.show', $user->id)}}">Voir absences</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
