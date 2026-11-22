<?php

namespace App\Http\Controllers;

use App\Models\Sujet;
use App\Models\Reponse;
use App\Models\CategorieForum;
use Illuminate\Http\Request;

class SujetController extends Controller
{
    public function create($categorieId)
    {
        $categorie = CategorieForum::findOrFail($categorieId);
        return view('forum.sujet-create', ['categorie' => $categorie]);
    }

    public function store(Request $request, $categorieId)
    {
        $donnees = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
        ]);

        $sujet = Sujet::create([
            'categorie_forum_id' => $categorieId,
            'user_id' => auth()->id(),
            'titre' => $donnees['titre'],
            'contenu' => $donnees['contenu'],
        ]);

        return redirect('/forum/sujet/' . $sujet->id);
    }

    public function show($id)
    {
        $sujet = Sujet::with(['auteur', 'categorie', 'reponses.auteur'])->findOrFail($id);
        return view('forum.sujet-show', ['sujet' => $sujet]);
    }

    public function repondre(Request $request, $id)
{
    $sujet = \App\Models\Sujet::findOrFail($id);

    if ($sujet->ferme) {
        return back()->withErrors(['contenu' => 'Ce sujet est fermé, les réponses ne sont plus acceptées.']);
    }

    $donnees = $request->validate([
        'contenu' => 'required|string',
    ]);

    Reponse::create([
        'sujet_id' => $id,
        'user_id' => auth()->id(),
        'contenu' => $donnees['contenu'],
    ]);

    return redirect('/forum/sujet/' . $id)->with('succes', 'Réponse publiée.');
}
}