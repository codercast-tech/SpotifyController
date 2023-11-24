# Kilytics6

Kilytics6 es un proyecto que interactúa con la API de Spotify para obtener detalles de canciones y artistas.

## Instalación

1. Clona este repositorio en tu máquina local:

   ```shell
   git clone https://github.com/djkanoell/Kilytics6.git
Instala las dependencias del proyecto:

shell
Copy code:

cd Kilytics6
composer install

Crea un archivo .env y configura tus credenciales de Spotify:

shell

cp .env.example .env

Edita el archivo .env y proporciona tu SPOTIFY_CLIENT_ID y SPOTIFY_CLIENT_SECRET.

Genera una clave de aplicación de Laravel:

shell

php artisan key:generate

Para utilizar este proyecto, sigue los pasos de instalación y luego puedes acceder a la funcionalidad de obtener detalles de una canción de Spotify a través de la URL:

http://tudominio.com/track/{ID_DE_LA_CANCION}


