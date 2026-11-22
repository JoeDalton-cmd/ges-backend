<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reponse;
use App\Models\Signalement;
use App\Models\Sujet;
use App\Models\User;
use Illuminate\Http\Request;

class ModerationController extends Controller
{
    // Liste des signalements
    public function signalements()
    {
        $signalements = Signalement::with(['sujet', 'reponse.auteur', 'reponse.sujet', 'auteur'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.moderation.signalements', ['signalements' => $signalements]);
    }

    public function traiterSignalement($id)
    {
        $signalement = Signalement::findOrFail($id);
        $signalement->update(['statut' => 'traite']);
        return back()->with('succes', 'Signalement marqué comme traité.');
    }

    // Liste de tous les sujets (pour modération)
    public function sujets()
    {
        $sujets = Sujet::with(['auteur', 'categorie'])->orderBy('created_at', 'desc')->get();
        return view('admin.moderation.sujets', ['sujets' => $sujets]);
    }

    public function togglePingle($id)
    {
        $sujet = Sujet::findOrFail($id);
        $sujet->update(['epingle' => !$sujet->epingle]);
        return back()->with('succes', 'Sujet mis à jour.');
    }

    public function toggleFerme($id)
    {
        $sujet = Sujet::findOrFail($id);
        $sujet->update(['ferme' => !$sujet->ferme]);
        return back()->with('succes', 'Sujet mis à jour.');
    }

    public function supprimerSujet($id)
    {
        Sujet::findOrFail($id)->delete();
        return back()->with('succes', 'Sujet supprimé.');
    }

    public function supprimerReponse($id)
    {
        Reponse::findOrFail($id)->delete();
        return back()->with('succes', 'Réponse supprimée.');
    }

    // Liste des membres (pour suspension)
    public function membres()
    {
        $membres = User::where('role', 'membre')->orderBy('name')->get();
        return view('admin.moderation.membres', ['membres' => $membres]);
    }

    public function toggleSuspension($id)
    {
        $membre = User::findOrFail($id);

        // On ne suspend jamais un administrateur (ni soi-même).
        if ($membre->role === 'admin' || $membre->id === auth()->id()) {
            return back()->withErrors(['membre' => 'Impossible de suspendre ce compte.']);
        }

        $membre->suspendu = ! $membre->suspendu;
        $membre->save();

        return back()->with('succes', 'Statut du membre mis à jour.');
    }
}
