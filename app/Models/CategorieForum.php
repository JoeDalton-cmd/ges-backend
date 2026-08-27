<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieForum extends Model
{
    protected $fillable = ['nom', 'description'];

    public function sujets()
    {
        return $this->hasMany(\App\Models\Sujet::class);
    }
}