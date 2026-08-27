<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\Piece;
use App\Models\Publication;
use App\Models\Inscription;
use App\Models\DemandePiece;
use App\Models\MessageContact;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'nbFormations' => Formation::count(),
            'nbPieces' => Piece::count(),
            'nbPublications' => Publication::count(),
            'nbInscriptions' => Inscription::count(),
            'nbDemandesPieces' => DemandePiece::count(),
            'nbMessages' => MessageContact::count(),
        ]);
    }
}