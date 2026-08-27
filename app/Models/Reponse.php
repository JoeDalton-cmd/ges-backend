<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    //
    protected $fillable = ['sujet_id', 'user_id', 'contenu'];

public function auteur()
{
    return $this->belongsTo(\App\Models\User::class, 'user_id');
}

}
