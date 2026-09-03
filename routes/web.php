<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FacturePdfController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Tableau de bord
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $userCount = User::count();

    $factures = \App\Models\Facture::latest()->get();

    $totalFactures = $factures->count();

    $facturesPayees = $factures->where('statut', 'payee')->count();

    $facturesImpayees = $factures->where('statut', 'impayee')->count();

    $montantTotal = $factures->sum('montant');

    $dernieresFactures = $factures->take(5);

    return view('home', compact(
        'userCount',
        'totalFactures',
        'facturesPayees',
        'facturesImpayees',
        'montantTotal',
        'dernieresFactures'
    ));

})->middleware('auth')->name('home');


/*
|--------------------------------------------------------------------------
| Connexion
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');


/*
|--------------------------------------------------------------------------
| Déconnexion
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| UTILISATEURS
| Réservé aux administrateurs
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('users', UserController::class);

});


/*
|--------------------------------------------------------------------------
| FACTURES
|--------------------------------------------------------------------------
*/

// Factures accessibles aux admin ET user
Route::middleware('auth')->group(function () {

    // Liste des factures
    Route::get('/factures', [FactureController::class, 'index'])
        ->name('factures.index');

    // Formulaire d'ajout
    Route::get('/factures/create', [FactureController::class, 'create'])
        ->name('factures.create');

    // Enregistrement
    Route::post('/factures', [FactureController::class, 'store'])
        ->name('factures.store');

    // Affichage
    Route::get('/factures/{facture}', [FactureController::class, 'show'])
        ->name('factures.show');

    // Formulaire de modification
    Route::get('/factures/{facture}/edit', [FactureController::class, 'edit'])
        ->name('factures.edit');

    // Modification
    Route::put('/factures/{facture}', [FactureController::class, 'update'])
        ->name('factures.update');

    // PDF
    Route::get('/factures/{id}/pdf', [FacturePdfController::class, 'generate'])
        ->name('factures.pdf');

});


/*
|--------------------------------------------------------------------------
| SUPPRESSION DES FACTURES
| Seulement ADMIN
|--------------------------------------------------------------------------
*/

Route::delete('/factures/{facture}', [FactureController::class, 'destroy'])
    ->middleware(['auth', 'admin'])
    ->name('factures.destroy');