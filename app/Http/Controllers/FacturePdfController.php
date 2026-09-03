<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturePdfController extends Controller
{
    public function generate($id)
    {
        $facture = Facture::findOrFail($id);

        $pdf = Pdf::loadView('factures.pdf', compact('facture'));

        return $pdf->download('facture-' . $facture->numero . '.pdf');
    }
}