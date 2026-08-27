<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sujet extends Model
{
    //
    protected $fillable = ['categorie_forum_id', 'user_id', 'titre', 'contenu', 'epingle', 'ferme'];

public function categorie()
{
    return $this->belongsTo(\App\Models\CategorieForum::class, 'categorie_forum_id');
}

public function auteur()
{
    return $this->belongsTo(\App\Models\User::class, 'user_id');
}

public function reponses()
{
    return $this->hasMany(\App\Models\Reponse::class);
}

}
