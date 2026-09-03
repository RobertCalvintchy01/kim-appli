<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Gestion de l’application')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f1eb;
            margin: 0;
            color: #3e2f24;
        }

        nav {
    background: #5a3825;
    padding: 12px 40px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 25px;
    min-height: 85px;
}
        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            color: #e6c9a8;
        }

        .content {
            padding: 40px;
            max-width: 1400px;
            margin: auto;
        }

        h1 {
            color: #5a3825;
            margin-bottom: 25px;
        }

        button,
        .btn {
            display: inline-block;
            background: #8b5e3c;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover,
        .btn:hover {
            background: #6f472f;
        }

        input,
        select {
            padding: 10px;
            border: 1px solid #cdbba8;
            border-radius: 5px;
            width: 100%;
            max-width: 500px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        th {
            background: #5a3825;
            color: white;
            padding: 14px;
            text-align: left;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #eadfd5;
        }

        tr:hover {
            background: #faf6f1;
        }

        .success {
            background: #dff2e1;
            color: #246b2a;
            padding: 12px 18px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .statut-impayee {
            background: #f8d7da;
            color: #842029;
            padding: 6px 10px;
            border-radius: 15px;
            font-weight: bold;
        }

        .statut-payee {
            background: #d1e7dd;
            color: #0f5132;
            padding: 6px 10px;
            border-radius: 15px;
            font-weight: bold;
        }

        .statut-brouillon {
            background: #fff3cd;
            color: #664d03;
            padding: 6px 10px;
            border-radius: 15px;
            font-weight: bold;
        }

        .btn-deconnexion {
    background: #8b5e3c;
    color: white;
    border: 1px solid #e6c9a8;
    padding: 9px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

.btn-deconnexion:hover {
    background: #6f472f;
}

.logo {
    height: 55px;
    width: auto;
    object-fit: contain;
}

.logo-link {
    display: flex;
    align-items: center;
    margin-right: 10px;
}
.logo {
    height: 55px;
    width: auto;
    display: block;
}

.logo {
    height: 80px;
    width: auto;
    display: block;
}

.logo-link {
    display: flex;
    align-items: center;
}
    </style>
</head>

<body>

<nav>
    <a href="{{ route('home') }}" class="logo-link">
        <img src="{{ asset('images/logo.jpg') }}" alt="African Sy" class="logo">
    </a>

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