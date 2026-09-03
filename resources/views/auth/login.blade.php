<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Connexion administrateur</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-box {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.12);
        }

        .login-box h1 {
            text-align: center;
            color: #5a3825;
            margin-bottom: 10px;
        }

        .login-box .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #3e2f24;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border: 1px solid #d8c8ba;
            border-radius: 7px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #5a3825;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 7px;
            background: #5a3825;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #3e2f24;
        }

        .error {
            background: #f8d7da;
            color: #842029;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .logo-text {
            text-align: center;
            color: #c58b00;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="login-box">

        <div class="logo-text">
            AFRICAN SY IMPORT EXPORT
        </div>

        <h1>Connexion</h1>

        <p class="subtitle">
            Accès à l'administration
        </p>

        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">

            @csrf

            <div class="form-group">

                <label for="email">
                    Adresse email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >

            </div>

            <div class="form-group">

                <label for="password">
                    Mot de passe
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >

            </div>

            <button type="submit" class="btn-login">
                Se connecter
            </button>

        </form>

    </div>

</div>

</body>
</html>