<?php

namespace App\Http\Controllers;

use App\Models\Publication;

class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::where('statut', 'publie')
            ->orderBy('publie_le', 'desc')
            ->get();
        return view('publications', ['publications' => $publications]);
    }

    public function show($id)
    {
        $publication = Publication::where('statut', 'publie')->findOrFail($id);
        return view('publication-detail', ['publication' => $publication]);
    }
}