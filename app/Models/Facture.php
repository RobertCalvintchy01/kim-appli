<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'numero',
        'date_facture',
        'client',
        'email',
        'montant',
        'statut',
    ];

    protected $casts = [
        'date_facture' => 'date',
        'montant' => 'decimal:2',
    ];
}