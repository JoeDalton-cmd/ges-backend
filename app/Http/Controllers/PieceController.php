<?php

namespace App\Http\Controllers;

use App\Models\Piece;

class PieceController extends Controller
{
    public function index()
    {
        $pieces = Piece::where('disponible', true)->get();
        return view('pieces', ['pieces' => $pieces]);
    }

    public function show($id)
    {
        $piece = Piece::findOrFail($id);
        return view('piece-detail', ['piece' => $piece]);
    }
}