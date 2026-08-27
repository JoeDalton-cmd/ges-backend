<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandePartenariat extends Model
{
    //
protected $fillable = ['nom_organisation', 'contact_nom', 'email', 'telephone', 'message', 'statut'];
}
