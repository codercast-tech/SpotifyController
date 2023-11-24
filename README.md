Documentación de SpotifyController
Introducción
El SpotifyController es una clase PHP que actúa como controlador para interactuar con la API de Spotify. Te permite obtener detalles de canciones, incluyendo características de audio e información de artistas, desde la API de Spotify. Esta documentación proporciona una descripción general de la clase, sus métodos y cómo utilizarla.

Requisitos Previos
Antes de usar el SpotifyController, asegúrate de tener los siguientes requisitos previos:

PHP instalado en tu servidor.
Composer instalado para gestionar las dependencias de PHP.
Una cuenta activa de desarrollador de Spotify con un ID de cliente y un secreto de cliente.
Instalación
Para utilizar el SpotifyController en tu proyecto PHP, sigue estos pasos:

Clona el repositorio o descarga el código en tu directorio de proyecto.

Ejecuta composer install para instalar las dependencias necesarias, incluyendo el cliente HTTP Guzzle.

Configura tus credenciales de la API de Spotify agregando tu ID de cliente y secreto de cliente en las variables de entorno de tu proyecto.

bash
Copy code
SPOTIFY_CLIENT_ID=tu-id-de-cliente
SPOTIFY_CLIENT_SECRET=tu-secreto-de-cliente
Incluye e instancia el SpotifyController en tu aplicación PHP según sea necesario.

Estructura de la Clase
La clase SpotifyController tiene la siguiente estructura:

__construct(): Inicializa la clase creando un cliente Guzzle HTTP y configurando las credenciales de la API de Spotify a partir de las variables de entorno.

authenticate(): Maneja la autenticación con la API de Spotify utilizando el flujo de credenciales de cliente. Almacena en caché el token de acceso para minimizar la autenticación repetida.

getTrackDetails($id): Obtiene los detalles de una canción de Spotify mediante su ID, incluyendo información de la canción, características de audio e información de los artistas.

getArtistInfo($artistIds): Obtiene información sobre artistas de Spotify mediante sus ID.

Uso
Aquí tienes un ejemplo de cómo utilizar el SpotifyController en tu aplicación PHP:

php
Copy code
use App\Http\Controllers\SpotifyController;

// Instancia el SpotifyController
$spotifyController = new SpotifyController();

// Obtiene detalles de una canción proporcionando su ID
$idCancion = 'tu-id-de-cancion';
$detallesCancion = $spotifyController->getTrackDetails($idCancion);

// Utiliza los datos de $detallesCancion en tu aplicación
Manejo de Errores
El SpotifyController incluye manejo de errores para varios escenarios, como autenticación fallida o solicitudes a la API con problemas. Registra los errores y proporciona vistas de error para que tu aplicación maneje estos casos de manera elegante.

Contribuciones
Si encuentras problemas o tienes sugerencias de mejoras, no dudes en contribuir a este proyecto mediante solicitudes de extracción o abriendo problemas en el repositorio de GitHub.

Licencia
Este proyecto está bajo la Licencia MIT.
