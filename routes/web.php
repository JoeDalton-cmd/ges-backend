<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
