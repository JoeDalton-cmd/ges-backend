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