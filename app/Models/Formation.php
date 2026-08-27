<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    //

    protected $fillable = [
    'titre', 'description', 'duree', 'prix',
    'date_debut', 'lieu', 'places_disponibles',
    'formateur', 'statut', 'image',
];
}
