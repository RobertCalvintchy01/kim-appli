<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail utilisateur</title>
</head>
<body>

    <h1>Détail de l'utilisateur</h1>

    <p>ID : {{ $user->id }}</p>
    <p>Nom : {{ $user->name }}</p>
    <p>Email : {{ $user->email }}</p>

    <a href="{{ route('users.index') }}">Retour à la liste</a>

</body>
</html>