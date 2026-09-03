
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Gestion des utilisateurs')</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
        }

        nav {
            background: #343a40;
            padding: 15px 40px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 25px;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .content {
            padding: 40px;
        }

        .btn-deconnexion {
    background: #8b5e3c;
    color: white;
    border: 1px solid #e6c9a8;
    padding: 9px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    margin-left: 10px;
}

.btn-deconnexion:hover {
    background: #6f472f;
}
    </style>
</head>

<body>

<nav>
    <a href="{{ route('home') }}">Accueil</a>

    @auth
        <a href="{{ route('factures.index') }}">Factures</a>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('users.index') }}">Utilisateurs</a>
            <a href="{{ route('users.create') }}">Ajouter un utilisateur</a>
        @endif

        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-deconnexion">
                Déconnexion
            </button>
        </form>
    @endauth
</nav>

<div class="content">
    @yield('content')
</div>

</body>
</html>
