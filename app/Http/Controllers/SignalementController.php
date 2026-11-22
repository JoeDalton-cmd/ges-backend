<?php

namespace App\Http\Controllers;

use App\Models\Signalement;
use Illuminate\Http\Request;

class SignalementController extends Controller
{
    public function store(Request $request)
    {
        $donnees = $request->validate([
            'sujet_id' => 'nullable|required_without:reponse_id|exists:sujets,id',
            'reponse_id' => 'nullable|required_without:sujet_id|exists:reponses,id',
            'raison' => 'required|string|max:255',
        ]);

        // Un membre ne peut pas signaler deux fois le même contenu tant qu'il n'est pas traité.
        Signalement::firstOrCreate(
            [
                'sujet_id' => $donnees['sujet_id'] ?? null,
                'reponse_id' => $donnees['reponse_id'] ?? null,
                'user_id' => auth()->id(),
                'statut' => 'nouveau',
            ],
            ['raison' => $donnees['raison']]
        );

        return back()->with('succes', 'Votre signalement a été envoyé aux modérateurs.');
    }
}
