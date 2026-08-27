<?php

namespace App\Http\Controllers;

use App\Models\MessageContact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $donnees = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:30',
            'sujet' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        MessageContact::create($donnees);

        return back()->with('succes', 'Votre message a bien été envoyé ! Nous vous répondrons rapidement.');
    }
}