<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $formations = \App\Models\Formation::where('statut', 'publie')->latest()->take(3)->get();
    $publications = \App\Models\Publication::where('statut', 'publie')->orderBy('publie_le', 'desc')->take(3)->get();
    return view('welcome', ['formations' => $formations, 'publications' => $publications]);
});
Route::get('/test', function () {
    return 'Bonjour GES, ça fonctionne !';
});
Route::get('/formations/{id}', function ($id) {
    $formation = \App\Models\Formation::findOrFail($id);
    return view('formation-detail', ['formation' => $formation]);
});
use App\Http\Controllers\InscriptionController;

Route::post('/inscriptions', [InscriptionController::class, 'store']);
use App\Http\Controllers\PieceController;

Route::get('/pieces', [PieceController::class, 'index']);
Route::get('/pieces/{id}', [PieceController::class, 'show']);
use App\Http\Controllers\DemandePieceController;

Route::post('/demandes-pieces', [DemandePieceController::class, 'store']);

use App\Http\Controllers\PublicationController;

Route::get('/publications', [PublicationController::class, 'index']);
Route::get('/publications/{id}', [PublicationController::class, 'show']);

use App\Http\Controllers\PartenaireController;

Route::get('/partenariats', [PartenaireController::class, 'index']);
Route::post('/partenariats', [PartenaireController::class, 'store']);

use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FormationController;
use App\Http\Controllers\Admin\PieceController as AdminPieceController;
use App\Http\Controllers\Admin\PublicationController as AdminPublicationController;
use App\Http\Controllers\Admin\PartenaireController as AdminPartenaireController;
use App\Http\Controllers\Admin\InscriptionController as AdminInscriptionController;
use App\Http\Controllers\Admin\DemandePieceController as AdminDemandePieceController;
use App\Http\Controllers\Admin\MessageContactController as AdminMessageContactController;
use App\Http\Controllers\Admin\ModerationController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        

        Route::get('/formations', [FormationController::class, 'index']);
        Route::get('/formations/creer', [FormationController::class, 'create']);
        Route::post('/formations', [FormationController::class, 'store']);
        Route::get('/formations/{id}/modifier', [FormationController::class, 'edit']);
        Route::put('/formations/{id}', [FormationController::class, 'update']);
        Route::delete('/formations/{id}', [FormationController::class, 'destroy']);

        Route::get('/pieces', [AdminPieceController::class, 'index']);
Route::get('/pieces/creer', [AdminPieceController::class, 'create']);
Route::post('/pieces', [AdminPieceController::class, 'store']);
Route::get('/pieces/{id}/modifier', [AdminPieceController::class, 'edit']);
Route::put('/pieces/{id}', [AdminPieceController::class, 'update']);
Route::delete('/pieces/{id}', [AdminPieceController::class, 'destroy']);

Route::get('/publications', [AdminPublicationController::class, 'index']);
Route::get('/publications/creer', [AdminPublicationController::class, 'create']);
Route::post('/publications', [AdminPublicationController::class, 'store']);
Route::get('/publications/{id}/modifier', [AdminPublicationController::class, 'edit']);
Route::put('/publications/{id}', [AdminPublicationController::class, 'update']);
Route::delete('/publications/{id}', [AdminPublicationController::class, 'destroy']);

Route::get('/partenaires', [AdminPartenaireController::class, 'index']);
Route::get('/partenaires/creer', [AdminPartenaireController::class, 'create']);
Route::post('/partenaires', [AdminPartenaireController::class, 'store']);
Route::get('/partenaires/{id}/modifier', [AdminPartenaireController::class, 'edit']);
Route::put('/partenaires/{id}', [AdminPartenaireController::class, 'update']);
Route::delete('/partenaires/{id}', [AdminPartenaireController::class, 'destroy']);

Route::get('/inscriptions', [AdminInscriptionController::class, 'index']);
Route::put('/inscriptions/{id}/statut', [AdminInscriptionController::class, 'updateStatut']);
 
Route::get('/demandes-pieces', [AdminDemandePieceController::class, 'index']);
Route::put('/demandes-pieces/{id}/statut', [AdminDemandePieceController::class, 'updateStatut']);

Route::get('/messages', [AdminMessageContactController::class, 'index']);
Route::put('/messages/{id}/statut', [AdminMessageContactController::class, 'updateStatut']);

Route::get('/moderation/signalements', [ModerationController::class, 'signalements']);
Route::put('/moderation/signalements/{id}/traiter', [ModerationController::class, 'traiterSignalement']);

Route::get('/moderation/sujets', [ModerationController::class, 'sujets']);
Route::put('/moderation/sujets/{id}/epingler', [ModerationController::class, 'togglePingle']);
Route::put('/moderation/sujets/{id}/fermer', [ModerationController::class, 'toggleFerme']);
Route::delete('/moderation/sujets/{id}', [ModerationController::class, 'supprimerSujet']);
Route::delete('/moderation/reponses/{id}', [ModerationController::class, 'supprimerReponse']);

Route::get('/moderation/membres', [ModerationController::class, 'membres']);
Route::put('/moderation/membres/{id}/suspendre', [ModerationController::class, 'toggleSuspension']);
});
});
use App\Http\Controllers\MembreAuthController;

Route::get('/forum/inscription', [MembreAuthController::class, 'showRegister']);
Route::post('/forum/inscription', [MembreAuthController::class, 'register']);
Route::get('/forum/connexion', [MembreAuthController::class, 'showLogin']);
Route::post('/forum/connexion', [MembreAuthController::class, 'login']);
Route::post('/forum/deconnexion', [MembreAuthController::class, 'logout']);

use App\Http\Controllers\ForumController;

Route::get('/forum', [ForumController::class, 'index']);
Route::get('/forum/categorie/{id}', [ForumController::class, 'categorie']);

use App\Http\Controllers\SujetController;

Route::get('/forum/sujet/{id}', [SujetController::class, 'show']);

Route::middleware(['auth', 'actif'])->group(function () {
    Route::post('/forum/signaler', [\App\Http\Controllers\SignalementController::class, 'store']);
    Route::get('/forum/categorie/{id}/nouveau-sujet', [SujetController::class, 'create']);
    Route::post('/forum/categorie/{id}/nouveau-sujet', [SujetController::class, 'store']);
    Route::post('/forum/sujet/{id}/repondre', [SujetController::class, 'repondre']);
});

