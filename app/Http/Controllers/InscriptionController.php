<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function store(Request $request)
    {
        $donnees = $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'nom_complet' => 'required|string|max:255',
            'telephone' => 'required|string|max:30',
            'email' => 'required|email',
            'niveau_etude' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        Inscription::create($donnees);

        return back()->with('succes', 'Votre inscription a bien été enregistrée ! Nous vous contacterons bientôt.');
    }
}