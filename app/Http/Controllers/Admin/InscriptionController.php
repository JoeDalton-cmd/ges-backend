<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function index()
    {
        $inscriptions = Inscription::with('formation')->orderBy('created_at', 'desc')->get();
        return view('admin.inscriptions.index', ['inscriptions' => $inscriptions]);
    }

    public function updateStatut(Request $request, $id)
    {
        $inscription = Inscription::findOrFail($id);
        $inscription->update(['statut' => $request->statut]);
        return back()->with('succes', 'Statut mis à jour.');
    }
}
