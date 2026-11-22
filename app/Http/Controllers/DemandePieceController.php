<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemandePiece;
use Illuminate\Http\Request;

class DemandePieceController extends Controller
{
    public function index()
    {
        $demandes = DemandePiece::with('piece')->orderBy('created_at', 'desc')->get();
        return view('admin.demandes-pieces.index', ['demandes' => $demandes]);
    }

    public function updateStatut(Request $request, $id)
    {
        $demande = DemandePiece::findOrFail($id);
        $demande->update(['statut' => $request->statut]);
        return back()->with('succes', 'Statut mis à jour.');
    }
}