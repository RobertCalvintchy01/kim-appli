<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;

class FactureController extends Controller
{
    /**
     * Afficher la liste des factures.
     */
   public function index()
{
   $recherche = request('recherche');

$recherche = request('recherche');
$statut = request('statut');

$factures = Facture::when($recherche, function ($query) use ($recherche) {
    $query->where('numero', 'like', '%' . $recherche . '%')
          ->orWhere('client', 'like', '%' . $recherche . '%')
          ->orWhere('email', 'like', '%' . $recherche . '%');
})
->when($statut, function ($query) use ($statut) {
    $query->where('statut', $statut);
})
->latest()
->paginate(10)
->withQueryString();

    $totalFactures = $factures->count();

    $facturesPayees = $factures->where('statut', 'payee')->count();

    $facturesImpayees = $factures->where('statut', 'impayee')->count();

    $montantTotal = $factures->sum('montant');

    return view('factures.index', compact(
        'factures',
        'totalFactures',
        'facturesPayees',
        'facturesImpayees',
        'montantTotal'
    ));
}

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        return view('factures.create');
    }

    /**
     * Enregistrer une nouvelle facture.
     */
   public function store(Request $request)
{
    $request->validate([
        'numero' => 'required|string|max:255|unique:factures,numero',
        'date_facture' => 'required|date',
        'client' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'montant' => 'required|numeric|min:0',
        'statut' => 'required|in:impayee,payee,brouillon',
    ]);

    Facture::create([
        'numero' => $request->numero,
        'date_facture' => $request->date_facture,
        'client' => $request->client,
        'email' => $request->email,
        'montant' => $request->montant,
        'statut' => $request->statut,
    ]);

    return redirect()
        ->route('factures.index')
        ->with('success', 'Facture créée avec succès !');
}

    /**
     * Afficher une facture.
     */
    public function show(string $id)
{
    $facture = Facture::findOrFail($id);

    return view('factures.show', compact('facture'));
}

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(string $id)
{
    $facture = Facture::findOrFail($id);

    return view('factures.edit', compact('facture'));
}
    /**
     * Modifier une facture.
     */
    public function update(Request $request, string $id)
{
    $facture = Facture::findOrFail($id);

    $request->validate([
        'numero' => 'required|string|max:255|unique:factures,numero,' . $facture->id,
        'date_facture' => 'required|date',
        'client' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'montant' => 'required|numeric|min:0',
        'statut' => 'required|in:impayee,payee,brouillon',
    ]);

    $facture->update([
        'numero' => $request->numero,
        'date_facture' => $request->date_facture,
        'client' => $request->client,
        'email' => $request->email,
        'montant' => $request->montant,
        'statut' => $request->statut,
    ]);

    return redirect()
        ->route('factures.index')
        ->with('success', 'Facture modifiée avec succès !');
}
    /**
     * Supprimer une facture.
     */
   public function destroy(string $id)
{
    $facture = Facture::findOrFail($id);

    $facture->delete();

    return redirect()
        ->route('factures.index')
        ->with('success', 'Facture supprimée avec succès !');
}
}