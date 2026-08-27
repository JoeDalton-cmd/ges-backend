<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    //
    protected $fillable = [
    'nom', 'description', 'categorie', 'marque',
    'etat', 'reference', 'prix', 'disponible', 'image',
];
}
