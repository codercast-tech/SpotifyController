<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Pista</title>
    <!-- Añade los enlaces a tus hojas de estilo aquí -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #5D647B;
        }
        .track-details, .audio-features {
            margin-bottom: 20px;
        }
        .audio-features p, .track-details p {
            font-size: 0.9em;
            line-height: 1.6;
            color: #666;
        }
        .not-available {
            color: #888;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles de la Pista</h1>
        @if(isset($trackInfo))
        <div class="track-details">
                <!-- Información de la pista -->
                <p>Nombre: {{ $trackInfo['name'] ?? 'Nombre no disponible' }}</p>
                <p>Artistas: {{ implode(', ', array_column($trackInfo['artists'] ?? [], 'name')) }}</p>
                <p>Álbum: {{ $trackInfo['album']['name'] ?? 'Álbum no disponible' }}</p>
                <p>Duración: {{ gmdate("i:s", $trackInfo['duration_ms'] / 1000) }}</p>
                <p>Popularidad: {{ $trackInfo['popularity'] ?? 'Popularidad no disponible' }}</p>
                <p>Preview URL: <a href="{{ $trackInfo['preview_url'] ?? '#' }}" target="_blank">Escuchar previa</a></p>
                <p>Número de Track: {{ $trackInfo['track_number'] ?? 'Número no disponible' }}</p>
                <!-- Información del álbum -->
                <p>Fecha de Lanzamiento: {{ $trackInfo['album']['release_date'] ?? 'Fecha no disponible' }}</p>
                <p>Mercados Disponibles: {{ implode(', ', $trackInfo['album']['available_markets'] ?? []) }}</p>
                <!-- Imágenes del álbum -->
                @if(isset($trackInfo['album']['images']))
                    <div>
                        <h3>Imágenes del Álbum</h3>
                        @foreach($trackInfo['album']['images'] as $image)
                            <img src="{{ $image['url'] }}" width="{{ $image['width'] }}" height="{{ $image['height'] }}">
                        @endforeach
                    </div>
                @endif
            </div>
            <!-- Características de Audio -->
            <div class="audio-features">
                <h3>Características de Audio</h3>
                <!-- Tus características de audio aquí -->
            </div>
            <!-- Información del Artista -->
            @if(isset($trackInfo['artists_info']))
                <div class="artist-info">
                    <h3>Información del Artista</h3>
                    @foreach($trackInfo['artists_info'] as $artist)
                        <p>Nombre: {{ $artist['name'] }}</p>
                        <p>Géneros: {{ implode(', ', $artist['genres'] ?? []) }}</p>
                        <p>Popularidad: {{ $artist['popularity'] }}</p>
                        <p>Seguidores: {{ $artist['followers']['total'] }}</p>
                        <!-- Imágenes del artista -->
                        @if(isset($artist['images']))
                            @foreach($artist['images'] as $image)
                                <img src="{{ $image['url'] }}" width="{{ $image['width'] }}" height="{{ $image['height'] }}">
                            @endforeach
                        @endif
                    @endforeach
                </div>
                <div class="audio-features">
    <h3>Características de Audio</h3>
    <p>Danceability: {{ $trackInfo['audio_features']['danceability'] ?? 'Danceability no disponible' }}</p>
    <p>Energy: {{ $trackInfo['audio_features']['energy'] ?? 'Energy no disponible' }}</p>
    <p>Key: {{ $trackInfo['audio_features']['key'] ?? 'Key no disponible' }}</p>
    <p>Loudness: {{ $trackInfo['audio_features']['loudness'] ?? 'Loudness no disponible' }}</p>
    <p>Mode: {{ $trackInfo['audio_features']['mode'] ?? 'Mode no disponible' }}</p>
    <p>Speechiness: {{ $trackInfo['audio_features']['speechiness'] ?? 'Speechiness no disponible' }}</p>
    <p>Acousticness: {{ $trackInfo['audio_features']['acousticness'] ?? 'Acousticness no disponible' }}</p>
    <p>Instrumentalness: {{ $trackInfo['audio_features']['instrumentalness'] ?? 'Instrumentalness no disponible' }}</p>
    <p>Liveness: {{ $trackInfo['audio_features']['liveness'] ?? 'Liveness no disponible' }}</p>
    <p>Valence: {{ $trackInfo['audio_features']['valence'] ?? 'Valence no disponible' }}</p>
    <p>Tempo: {{ $trackInfo['audio_features']['tempo'] ?? 'Tempo no disponible' }}</p>
    <p>Time Signature: {{ $trackInfo['audio_features']['time_signature'] ?? 'Time Signature no disponible' }}</p>
    <!-- Añade aquí cualquier otra característica de audio que desees mostrar -->
</div>
            @endif
        @else
            <p class="not-available">Los detalles de la pista no están disponibles.</p>
        @endif
    </div>
    

       
</body>
</html>
