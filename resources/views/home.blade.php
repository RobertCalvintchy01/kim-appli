@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')

<style>
    .dashboard {
        max-width: 1200px;
        margin: 20px auto;
    }

    .welcome {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }

    .welcome h1 {
        margin-top: 0;
        color: #5a3825;
    }

    .welcome p {
        color: #666;
        font-size: 16px;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 22px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        text-align: center;
    }

    .stat-card h3 {
        margin: 0 0 10px;
        color: #5a3825;
        font-size: 16px;
    }

    .stat-number {
        font-size: 30px;
        font-weight: bold;
        color: #5a3825;
    }

    .paid {
        color: #198754;
    }

    .unpaid {
        color: #dc3545;
    }

    .amount {
        color: #5a3825;
        font-size: 24px;
    }

    .section {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }

    .section h2 {
        color: #5a3825;
        margin-top: 0;
    }

    .actions {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
    }

    .btn-dashboard {
        display: inline-block;
        padding: 11px 18px;
        border-radius: 7px;
        background: #5a3825;
        color: white;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-dashboard:hover {
        background: #3e2f24;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #5a3825;
        color: white;
        padding: 12px;
        text-align: left;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }

    .status {
        font-weight: bold;
    }

    .status-paid {
        color: #198754;
    }

    .status-unpaid {
        color: #dc3545;
    }

    .status-draft {
        color: #997404;
    }

    .users-info {
        margin-top: 20px;
        padding: 20px;
        background: #f8f3ef;
        border-radius: 10px;
    }

    @media (max-width: 900px) {
        .stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .stats {
            grid-template-columns: 1fr;
        }

        .actions {
            flex-direction: column;
        }
    }
</style>


<div class="dashboard">

    <!-- BIENVENUE -->
    <div class="welcome">

        <h1>Bienvenue dans votre tableau de bord 👋</h1>

        <p>
            Gérez facilement vos factures et vos utilisateurs
            depuis votre application.
        </p>

    </div>


    <!-- STATISTIQUES -->
    <div class="stats">

        <div class="stat-card">

            <h3>🧾 Total factures</h3>

            <div class="stat-number">
                {{ $totalFactures }}
            </div>

        </div>


        <div class="stat-card">

            <h3>✅ Factures payées</h3>

            <div class="stat-number paid">
                {{ $facturesPayees }}
            </div>

        </div>


        <div class="stat-card">

            <h3>🔴 Factures impayées</h3>

            <div class="stat-number unpaid">
                {{ $facturesImpayees }}
            </div>

        </div>


        <div class="stat-card">

            <h3>💰 Montant total</h3>

            <div class="stat-number amount">
                {{ number_format($montantTotal, 2, ',', ' ') }} €
            </div>

        </div>

    </div>


    <!-- ACTIONS -->
    <div class="section">

        <h2>Actions rapides</h2>

        <div class="actions">

            <a href="{{ route('factures.index') }}"
               class="btn-dashboard">
                🧾 Voir les factures
            </a>

            <a href="{{ route('factures.create') }}"
               class="btn-dashboard">
                ➕ Nouvelle facture
            </a>

            <a href="{{ route('users.index') }}"
               class="btn-dashboard">
                👥 Utilisateurs
            </a>

        </div>

        <div class="users-info">

            <strong>👥 Utilisateurs enregistrés :</strong>

            {{ $userCount }}

        </div>

    </div>


    <!-- DERNIÈRES FACTURES -->
    <div class="section">

        <h2>📋 Dernières factures</h2>

        @if($dernieresFactures->isEmpty())

            <p>Aucune facture enregistrée.</p>

        @else

            <table>

                <thead>

                    <tr>
                        <th>Numéro</th>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th></th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($dernieresFactures as $facture)

                        <tr>

                            <td>
                                <strong>
                                    {{ $facture->numero }}
                                </strong>
                            </td>

                            <td>
                                {{ $facture->date_facture->format('d/m/Y') }}
                            </td>

                            <td>
                                {{ $facture->client }}
                            </td>

                            <td>
                                {{ number_format($facture->montant, 2, ',', ' ') }} €
                            </td>

                            <td>

                                @if($facture->statut === 'payee')

                                    <span class="status status-paid">
                                        Payée
                                    </span>

                                @elseif($facture->statut === 'impayee')

                                    <span class="status status-unpaid">
                                        Impayée
                                    </span>

                                @else

                                    <span class="status status-draft">
                                        Brouillon
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('factures.show', $facture->id) }}"
                                   class="btn-dashboard">
                                    Voir
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @endif

    </div>

</div>

@endsection