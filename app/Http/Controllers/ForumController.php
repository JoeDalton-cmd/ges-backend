<?php

namespace App\Http\Controllers;

use App\Models\CategorieForum;
use App\Models\Sujet;

class ForumController extends Controller
{
    public function index()
    {
        $categories = CategorieForum::withCount('sujets')->get();
        return view('forum.index', ['categories' => $categories]);
    }

    public function categorie($id)
    {
        $categorie = CategorieForum::findOrFail($id);
        $sujets = Sujet::where('categorie_forum_id', $id)
            ->with('auteur')
            ->withCount('reponses')
            ->orderBy('epingle', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('forum.categorie', ['categorie' => $categorie, 'sujets' => $sujets]);
    }
}