<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpotifyController;

// Rutas web estándar, accesibles a través del navegador.

Route::get('/', function () {
    return view('welcome');
});

// Ruta para mostrar la vista de los detalles de una pista de Spotify
Route::get('/spotify/track/{id}', [SpotifyController::class, 'getTrackDetails']);
