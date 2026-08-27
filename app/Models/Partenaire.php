<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    //
    protected $fillable = ['nom', 'type', 'description', 'actions_realisees', 'logo', 'actif'];
}
