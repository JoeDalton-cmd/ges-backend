<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    //
    protected $fillable = [
    'formation_id', 'nom_complet', 'telephone', 'email',
    'niveau_etude', 'profession', 'message', 'statut',
];
public function formation()
{
    return $this->belongsTo(\App\Models\Formation::class);
}
}
