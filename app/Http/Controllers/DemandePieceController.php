<?php

namespace App\Http\Controllers;

use App\Models\DemandePiece;
use Illuminate\Http\Request;

class DemandePieceController extends Controller
{
    public function store(Request $request)
    {
        $donnees = $request->validate([
            'piece_id' => 'required|exists:pieces,id',
            'nom_complet' => 'required|string|max:255',
            'telephone' => 'required|string|max:30',
            'email' => 'nullable|email',
            'message' => 'nullable|string',
        ]);

        DemandePiece::create($donnees);

        return back()->with('succes', 'Votre demande a bien été envoyée ! Nous vous contacterons rapidement.');
    }
}