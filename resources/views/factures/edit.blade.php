@extends('layouts.app')

@section('title', 'Modifier la facture')

@section('content')

<h1>Modifier la facture</h1>

@if($errors->any())
    <div style="
        background: #f8d7da;
        color: #842029;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 25px;
    ">
        <strong>Veuillez corriger les erreurs :</strong>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div style="
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    max-width: 800px;
">

    <h2 style="color: #5a3825; margin-top: 0;">
        Informations de la facture
    </h2>

    <form action="{{ route('factures.update', $facture->id) }}" method="POST">

        @csrf
        @method('PUT')

        <p>
            <label for="numero">
                <strong>Numéro de facture</strong>
            </label><br>

            <input
                type="text"
                id="numero"
                name="numero"
                value="{{ old('numero', $facture->numero) }}"
                required
            >
        </p>

        <p>
            <label for="date_facture">
                <strong>Date de facture</strong>
            </label><br>

            <input
                type="date"
                id="date_facture"
                name="date_facture"
                value="{{ old('date_facture', $facture->date_facture->format('Y-m-d')) }}"
                required
            >
        </p>

        <p>
            <label for="client">
                <strong>Nom du client</strong>
            </label><br>

            <input
                type="text"
                id="client"
                name="client"
                value="{{ old('client', $facture->client) }}"
                required
            >
        </p>

        <p>
            <label for="email">
                <strong>Email du client</strong>
            </label><br>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $facture->email) }}"
            >
        </p>

        <p>
            <label for="montant">
                <strong>Montant (€)</strong>
            </label><br>

            <input
                type="number"
                id="montant"
                name="montant"
                step="0.01"
                min="0"
                value="{{ old('montant', $facture->montant) }}"
                required
            >
        </p>

        <p>
            <label for="statut">
                <strong>Statut</strong>
            </label><br>

            <select id="statut" name="statut" required>

                <option value="impayee"
                    {{ old('statut', $facture->statut) === 'impayee' ? 'selected' : '' }}>
                    Impayée
                </option>

                <option value="payee"
                    {{ old('statut', $facture->statut) === 'payee' ? 'selected' : '' }}>
                    Payée
                </option>

                <option value="brouillon"
                    {{ old('statut', $facture->statut) === 'brouillon' ? 'selected' : '' }}>
                    Brouillon
                </option>

            </select>
        </p>

        <div style="
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eadfd5;
        ">

            <button type="submit" class="btn">
                Enregistrer les modifications
            </button>

            <a href="{{ route('factures.index') }}"
               class="btn"
               style="margin-left: 10px;">
                Annuler
            </a>

        </div>

    </form>

</div>

@endsection