<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Piece;
use Illuminate\Http\Request;

class PieceController extends Controller
{
    public function index()
    {
        $pieces = Piece::orderBy('created_at', 'desc')->get();
        return view('admin.pieces.index', ['pieces' => $pieces]);
    }

    public function create()
    {
        return view('admin.pieces.create');
    }

    public function store(Request $request)
    {
        $donnees = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie' => 'nullable|string|max:255',
            'marque' => 'nullable|string|max:255',
            'etat' => 'required|in:neuf,occasion',
            'reference' => 'nullable|string|max:255',
            'prix' => 'required|integer',
            'disponible' => 'required|boolean',
        ]);

        Piece::create($donnees);

        return redirect('/admin/pieces')->with('succes', 'Pièce créée avec succès.');
    }

    public function edit($id)
    {
        $piece = Piece::findOrFail($id);
        return view('admin.pieces.edit', ['piece' => $piece]);
    }

    public function update(Request $request, $id)
    {
        $piece = Piece::findOrFail($id);

        $donnees = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie' => 'nullable|string|max:255',
            'marque' => 'nullable|string|max:255',
            'etat' => 'required|in:neuf,occasion',
            'reference' => 'nullable|string|max:255',
            'prix' => 'required|integer',
            'disponible' => 'required|boolean',
        ]);

        $piece->update($donnees);

        return redirect('/admin/pieces')->with('succes', 'Pièce modifiée avec succès.');
    }

    public function destroy($id)
    {
        Piece::findOrFail($id)->delete();
        return redirect('/admin/pieces')->with('succes', 'Pièce supprimée.');
    }
}
