<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    public function index()
    {
        $partenaires = Partenaire::orderBy('created_at', 'desc')->get();
        return view('admin.partenaires.index', ['partenaires' => $partenaires]);
    }

    public function create()
    {
        return view('admin.partenaires.create');
    }

    public function store(Request $request)
    {
        $donnees = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'actions_realisees' => 'nullable|string',
            'actif' => 'required|boolean',
        ]);

        Partenaire::create($donnees);

        return redirect('/admin/partenaires')->with('succes', 'Partenaire créé avec succès.');
    }

    public function edit($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        return view('admin.partenaires.edit', ['partenaire' => $partenaire]);
    }

    public function update(Request $request, $id)
    {
        $partenaire = Partenaire::findOrFail($id);

        $donnees = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'actions_realisees' => 'nullable|string',
            'actif' => 'required|boolean',
        ]);

        $partenaire->update($donnees);

        return redirect('/admin/partenaires')->with('succes', 'Partenaire modifié avec succès.');
    }

    public function destroy($id)
    {
        Partenaire::findOrFail($id)->delete();
        return redirect('/admin/partenaires')->with('succes', 'Partenaire supprimé.');
    }
}
