<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    //
    protected $fillable = ['titre', 'contenu', 'categorie', 'image', 'statut', 'publie_le'];
}
