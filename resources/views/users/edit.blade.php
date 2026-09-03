@extends('layouts.app')

@section('title', 'Modifier un utilisateur')

@section('content')

<style>
    .form-container {
        max-width: 600px;
        margin: 20px auto;
        background: #ffffff;
        padding: 35px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.10);
    }

    .form-title {
        text-align: center;
        margin-top: 0;
        margin-bottom: 30px;
        color: #343a40;
        font-size: 28px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #343a40;
    }

    .form-group input {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #ced4da;
        border-radius: 7px;
        box-sizing: border-box;
        font-size: 15px;
        transition: 0.2s;
    }

    .form-group input:focus {
        outline: none;
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.12);
    }

    .btn-container {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 28px;
    }

    .btn-save {
        background: #0d6efd;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 7px;
        cursor: pointer;
        font-size: 15px;
        font-weight: bold;
        transition: 0.2s;
    }

    .btn-save:hover {
        background: #0b5ed7;
    }

    .btn-back {
        background: #6c757d;
        color: white;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 7px;
        font-size: 15px;
        font-weight: bold;
        transition: 0.2s;
    }

    .btn-back:hover {
        background: #5c636a;
    }

    .errors {
        background: #f8d7da;
        color: #842029;
        padding: 12px 15px;
        border-radius: 7px;
        margin-bottom: 22px;
        border: 1px solid #f1aeb5;
    }

    .errors ul {
        margin: 0;
        padding-left: 20px;
    }

    .errors li {
        margin-bottom: 5px;
    }
</style>

<div class="form-container">

    <h1 class="form-title">Modifier un utilisateur</h1>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
            >
        </div>

        <div class="btn-container">

            <button type="submit" class="btn-save">
                Enregistrer les modifications
            </button>

            <a href="{{ route('users.index') }}" class="btn-back">
                Retour à la liste
            </a>

        </div>

    </form>

</div>

@endsection