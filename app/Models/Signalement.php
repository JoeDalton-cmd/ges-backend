<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signalement extends Model
{
    protected $fillable = ['sujet_id', 'reponse_id', 'user_id', 'raison', 'statut'];

    public function sujet()
    {
        return $this->belongsTo(\App\Models\Sujet::class);
    }

    public function reponse()
    {
        return $this->belongsTo(\App\Models\Reponse::class);
    }

    public function auteur()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
