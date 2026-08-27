<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::orderBy('created_at', 'desc')->get();
        return view('admin.publications.index', ['publications' => $publications]);
    }

    public function create()
    {
        return view('admin.publications.create');
    }

    public function store(Request $request)
    {
        $donnees = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'categorie' => 'nullable|string|max:255',
            'statut' => 'required|in:brouillon,publie',
        ]);

        if ($donnees['statut'] === 'publie') {
            $donnees['publie_le'] = now();
        }

        Publication::create($donnees);

        return redirect('/admin/publications')->with('succes', 'Publication créée avec succès.');
    }

    public function edit($id)
    {
        $publication = Publication::findOrFail($id);
        return view('admin.publications.edit', ['publication' => $publication]);
    }

    public function update(Request $request, $id)
    {
        $publication = Publication::findOrFail($id);

        $donnees = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'categorie' => 'nullable|string|max:255',
            'statut' => 'required|in:brouillon,publie',
        ]);

        if ($donnees['statut'] === 'publie' && $publication->statut !== 'publie') {
            $donnees['publie_le'] = now();
        }

        $publication->update($donnees);

        return redirect('/admin/publications')->with('succes', 'Publication modifiée avec succès.');
    }

    public function destroy($id)
    {
        Publication::findOrFail($id)->delete();
        return redirect('/admin/publications')->with('succes', 'Publication supprimée.');
    }
}
