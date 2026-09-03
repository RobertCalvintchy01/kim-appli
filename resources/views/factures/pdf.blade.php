<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <title>Facture {{ $facture->numero }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #3e2f24;
            font-size: 13px;
            margin: 0;
            padding: 30px;
        }

        .header {
            border-bottom: 3px solid #5a3825;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .logo {
            width: 150px;
            height: auto;
            margin-bottom: 8px;
        }

        .entreprise {
            color: #5a3825;
        }

        .entreprise p {
            margin: 5px 0;
        }

        .facture-title {
            text-align: right;
            margin-top: -150px;
            margin-bottom: 80px;
        }

        .facture-title h2 {
            font-size: 30px;
            color: #5a3825;
            margin: 0 0 10px 0;
        }

        .facture-title p {
            margin: 5px 0;
        }

        .client {
            margin-top: 20px;
            border: 1px solid #d8c8ba;
            padding: 15px;
            width: 45%;
        }

        .client h3 {
            margin-top: 0;
            color: #5a3825;
            font-size: 15px;
        }

        .client p {
            margin: 6px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
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

        .total {
            width: 45%;
            margin-left: auto;
            margin-top: 25px;
        }

        .total td {
            font-size: 15px;
            font-weight: bold;
        }

        .total-final {
            background: #f3ebe5;
            color: #5a3825;
            font-size: 18px !important;
        }

        .statut {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 12px;
            font-weight: bold;
        }

        .payee {
            background: #d1e7dd;
            color: #0f5132;
        }

        .impayee {
            background: #f8d7da;
            color: #842029;
        }

        .brouillon {
            background: #fff3cd;
            color: #664d03;
        }

        .signature {
            margin-top: 60px;
            width: 45%;
            text-align: center;
        }

        .signature-title {
            color: #5a3825;
            font-weight: bold;
            margin-bottom: 35px;
        }

        .signature-line {
            border-top: 1px solid #5a3825;
            padding-top: 8px;
        }

        .merci {
            text-align: center;
            margin-top: 45px;
            color: #5a3825;
            font-size: 13px;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 20px;
            left: 30px;
            right: 30px;
            text-align: center;
            border-top: 1px solid #d8c8ba;
            padding-top: 10px;
            color: #6f6258;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <!-- EN-TÊTE -->
    <div class="header">

        <div class="entreprise">

            <img
                src="{{ public_path('images/logo.jpg') }}"
                class="logo"
            >

            <p>
                12 RUE AL AZHAR GH 4000<br>
                Casablanca
            </p>

            <p>
                Téléphone : 06 95 09 01 18<br>
                Email : contact@africanSyimportexport.com
            </p>

        </div>

        <div class="facture-title">

            <h2>FACTURE</h2>

            <p>
                <strong>N° :</strong>
                {{ $facture->numero }}
            </p>

            <p>
                <strong>Date :</strong>
                {{ $facture->date_facture->format('d/m/Y') }}
            </p>

        </div>

    </div>


    <!-- CLIENT -->
    <div class="client">

        <h3>FACTURÉ À</h3>

        <p>
            <strong>{{ $facture->client }}</strong>
        </p>

        @if($facture->email)
            <p>
                {{ $facture->email }}
            </p>
        @endif

    </div>


    <!-- FACTURE -->
    <table>

        <thead>
            <tr>
                <th>Description</th>

                <th style="text-align: right;">
                    Montant
                </th>
            </tr>
        </thead>

        <tbody>

            <tr>

                <td>
                    Prestation / Vente
                </td>

                <td style="text-align: right;">
                    {{ number_format($facture->montant, 2, ',', ' ') }} €
                </td>

            </tr>

        </tbody>

    </table>


    <!-- TOTAL -->
    <table class="total">

        <tr class="total-final">

            <td>
                TOTAL À PAYER
            </td>

            <td style="text-align: right;">
                {{ number_format($facture->montant, 2, ',', ' ') }} €
            </td>

        </tr>

        <tr>

            <td>
                STATUT
            </td>

            <td style="text-align: right;">

                @if($facture->statut === 'payee')

                    <span class="statut payee">
                        PAYÉE
                    </span>

                @elseif($facture->statut === 'impayee')

                    <span class="statut impayee">
                        IMPAYÉE
                    </span>

                @else

                    <span class="statut brouillon">
                        BROUILLON
                    </span>

                @endif

            </td>

        </tr>

    </table>


    <!-- SIGNATURE -->
    <div class="signature">

        <div class="signature-title">
            Signature et cachet
        </div>

        <div class="signature-line">
            AFRICAN SY IMPORT EXPORT
        </div>

    </div>


    <!-- REMERCIEMENT -->
    <div class="merci">
        Merci pour votre confiance.
    </div>


    <!-- PIED DE PAGE -->
    <div class="footer">

        AFRICAN SY IMPORT EXPORT —
        12 RUE AL AZHAR GH 4000, Casablanca —
        06 95 09 01 18 —
        contact@africanSyimportexport.com

    </div>

</body>
</html>