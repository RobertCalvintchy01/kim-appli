@extends('layouts.app')

@section('title', 'Détail de la facture')

@section('content')

<h1>Détail de la facture</h1>

<div style="
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    max-width: 800px;
">

    <h2 style="color: #5a3825;">
        Facture {{ $facture->numero }}
    </h2>

    <hr>

    <p>
        <strong>Numéro :</strong>
        {{ $facture->numero }}
    </p>

    <p>
        <strong>Date :</strong>
        {{ $facture->date_facture->format('d/m/Y') }}
    </p>

    <p>
        <strong>Client :</strong>
        {{ $facture->client }}
    </p>

    <p>
        <strong>Email :</strong>
        {{ $facture->email ?: 'Non renseigné' }}
    </p>

    <p>
        <strong>Montant :</strong>
        {{ number_format($facture->montant, 2, ',', ' ') }} €
    </p>

    <p>
        <strong>Statut :</strong>

        @if($facture->statut === 'payee')
            <span class="statut-payee">Payée</span>

        @elseif($facture->statut === 'impayee')
            <span class="statut-impayee">Impayée</span>

        @else
            <span class="statut-brouillon">Brouillon</span>
        @endif
    </p>

    <br>

    <a href="{{ route('factures.pdf', $facture->id) }}" class="btn">
    📄 Télécharger PDF
</a>

<a href="{{ route('factures.index') }}"
   class="btn"
   style="margin-left: 10px;">
    ← Retour aux factures
</a>

</div>

@endsection