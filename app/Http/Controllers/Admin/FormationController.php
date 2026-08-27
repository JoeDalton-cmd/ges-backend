<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    // Affiche la liste
    public function index()
    {
        $formations = Formation::orderBy('created_at', 'desc')->get();
        return view('admin.formations.index', ['formations' => $formations]);
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('admin.formations.create');
    }

    // Enregistre une nouvelle formation
    public function store(Request $request)
    {
        $donnees = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|string|max:100',
            'prix' => 'required|integer',
            'lieu' => 'nullable|string|max:255',
            'places_disponibles' => 'nullable|integer',
            'formateur' => 'nullable|string|max:255',
            'statut' => 'required|in:brouillon,publie',
        ]);

        Formation::create($donnees);

        return redirect('/admin/formations')->with('succes', 'Formation créée avec succès.');
    }

    // Affiche le formulaire pré-rempli pour modifier
    public function edit($id)
    {
        $formation = Formation::findOrFail($id);
        return view('admin.formations.edit', ['formation' => $formation]);
    }

    // Enregistre les modifications
    public function update(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        $donnees = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'duree' => 'required|string|max:100',
            'prix' => 'required|integer',
            'lieu' => 'nullable|string|max:255',
            'places_disponibles' => 'nullable|integer',
            'formateur' => 'nullable|string|max:255',
            'statut' => 'required|in:brouillon,publie',
        ]);

        $formation->update($donnees);

        return redirect('/admin/formations')->with('succes', 'Formation modifiée avec succès.');
    }

    // Supprime
    public function destroy($id)
    {
        Formation::findOrFail($id)->delete();
        return redirect('/admin/formations')->with('succes', 'Formation supprimée.');
    }
}
