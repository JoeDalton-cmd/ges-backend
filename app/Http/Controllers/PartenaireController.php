<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Models\DemandePartenariat;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    public function index()
    {
        $partenaires = Partenaire::where('actif', true)->get();
        return view('partenaires', ['partenaires' => $partenaires]);
    }

    public function store(Request $request)
    {
        $donnees = $request->validate([
            'nom_organisation' => 'required|string|max:255',
            'contact_nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:30',
            'message' => 'required|string',
        ]);

        DemandePartenariat::create($donnees);

        return back()->with('succes', 'Votre proposition de partenariat a bien été envoyée !');
    }
}