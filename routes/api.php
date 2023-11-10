<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpotifyController;

// Todas las rutas aquí estarán prefijadas con 'api/'

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Ruta de API para obtener los detalles y características de audio de una pista de Spotify
Route::get('/spotify/track/{id}/details', [SpotifyController::class, 'getTrackDetails']);
