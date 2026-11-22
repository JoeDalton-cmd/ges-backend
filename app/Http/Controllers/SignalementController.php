<?php

namespace App\Http\Controllers;

use App\Models\Signalement;
use Illuminate\Http\Request;

class SignalementController extends Controller
{
    public function store(Request $request)
    {
        $donnees = $request->validate([
            'sujet_id' => 'nullable|exists:sujets,id',
            'reponse_id' => 'nullable|exists:reponses,id',
            'raison' => 'required|string|max:255',
        ]);

        Signalement::create([
            'sujet_id' => $donnees['sujet_id'] ?? null,
            'reponse_id' => $donnees['reponse_id'] ?? null,
            'user_id' => auth()->id(),
            'raison' => $donnees['raison'],
        ]);

        return back()->with('succes', 'Votre signalement a été envoyé aux modérateurs.');
    }
}