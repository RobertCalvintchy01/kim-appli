@extends('layouts.app')

@section('title', 'Liste des factures')

@section('content')
<div style="
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 30px;
">

    <div style="
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    ">
        <h3>Total factures</h3>
        <p style="font-size: 28px; font-weight: bold;">
            {{ $totalFactures }}
        </p>
    </div>

    <div style="
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    ">
        <h3>Factures payées</h3>
        <p style="font-size: 28px; font-weight: bold;">
            {{ $facturesPayees }}
        </p>
    </div>

    <div style="
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    ">
        <h3>Factures impayées</h3>
        <p style="font-size: 28px; font-weight: bold;">
            {{ $facturesImpayees }}
        </p>
    </div>

    <div style="
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    ">
        <h3>Montant total</h3>
        <p style="font-size: 24px; font-weight: bold;">
            {{ number_format($montantTotal, 2, ',', ' ') }} €
        </p>
    </div>

</div>

<h1>Liste des factures</h1>

@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

<div style="
    margin-bottom: 25px;
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
">

    <a href="{{ route('factures.create') }}" class="btn">
        + Nouvelle facture
    </a>

    <form action="{{ route('factures.index') }}" method="GET"
          style="display: flex; gap: 10px;">

        <input
            type="text"
            name="recherche"
            value="{{ request('recherche') }}"
            placeholder="🔎 Numéro, client ou email..."
            style="
                padding: 10px 15px;
                border: 1px solid #d8c8ba;
                border-radius: 7px;
                width: 280px;
            "
        >

        <select
    name="statut"
    style="
        padding: 10px 15px;
        border: 1px solid #d8c8ba;
        border-radius: 7px;
    "
>
    <option value="">Tous les statuts</option>

    <option value="payee"
        {{ request('statut') === 'payee' ? 'selected' : '' }}>
        Payées
    </option>

    <option value="impayee"
        {{ request('statut') === 'impayee' ? 'selected' : '' }}>
        Impayées
    </option>

    <option value="brouillon"
        {{ request('statut') === 'brouillon' ? 'selected' : '' }}>
        Brouillons
    </option>
</select>

        <button type="submit" class="btn">
            Rechercher
        </button>

        @if(request('recherche'))
            <a href="{{ route('factures.index') }}"
               class="btn">
                Effacer
            </a>
        @endif

    </form>

</div>
    
</div>

@if($factures->isEmpty())

    <p>Aucune facture enregistrée.</p>

@else

<table>
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Date</th>
            <th>Client</th>
            <th>Email</th>
            <th>Montant</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($factures as $facture)

            <tr>
                <td>
                    <strong>{{ $facture->numero }}</strong>
                </td>

                <td>
                    {{ $facture->date_facture->format('d/m/Y') }}
                </td>

                <td>
                    {{ $facture->client }}
                </td>

                <td>
                    {{ $facture->email }}
                </td>

                <td>
                    <strong>
                        {{ number_format($facture->montant, 2, ',', ' ') }} €
                    </strong>
                </td>

                <td>

                    @if($facture->statut === 'payee')
                        <span class="statut-payee">
                            Payée
                        </span>

                    @elseif($facture->statut === 'impayee')
                        <span class="statut-impayee">
                            Impayée
                        </span>

                    @else
                        <span class="statut-brouillon">
                            Brouillon
                        </span>
                    @endif

                </td>

               <td>
    <a href="{{ route('factures.show', $facture->id) }}"
       class="btn">
        Voir
    </a>

    <a href="{{ route('factures.edit', $facture->id) }}"
       class="btn">
        Modifier
    </a>

    <form action="{{ route('factures.destroy', $facture->id) }}"
          method="POST"
          style="display: inline;"
          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette facture ?');">

        @csrf
        @method('DELETE')

        <button type="submit" class="btn">
            Supprimer
        </button>

    </form>
</td>
            </tr>

        @endforeach
    </tbody>
</table>
       <div style="margin-top: 25px;">
        {{ $factures->links() }}
    </div>



@endif

@endsection