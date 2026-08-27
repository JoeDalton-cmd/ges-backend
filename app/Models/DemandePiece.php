<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandePiece extends Model
{
    //
    protected $fillable = ['piece_id', 'nom_complet', 'telephone', 'email', 'message', 'statut'];

    public function piece()
{
    return $this->belongsTo(\App\Models\Piece::class);
}
    }

