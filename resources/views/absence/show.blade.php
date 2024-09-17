<!DOCTYPE html>
<html>
<head>
    <title>Détails de l'Absence</title>
</head>
<body>
    <h1>Détails de l'Absence</h1>
    <p>ID : {{ $absence->id }}</p>
    <p>Utilisateur : {{ $user->prenom }} {{ $user->nom }}</p>
    <p>Motif : {{ $motif->Libelle }}</p>
    <p>Date de Début : {{ $absence->date_debut }}</p>
    <p>Date de Fin : {{ $absence->date_fin }}</p>
</body>
</html>
