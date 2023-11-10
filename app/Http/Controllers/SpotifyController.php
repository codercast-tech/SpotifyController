<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SpotifyController extends Controller
{
    private $client;
    private $clientId;
    private $clientSecret;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.spotify.com/v1/']);
        $this->clientId = env('SPOTIFY_CLIENT_ID');
        $this->clientSecret = env('SPOTIFY_CLIENT_SECRET');
    }

    private function authenticate()
    {
        if (Cache::has('spotify_token')) {
            return Cache::get('spotify_token');
        }

        try {
            $response = $this->client->post('https://accounts.spotify.com/api/token', [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            Cache::put('spotify_token', $body['access_token'], $body['expires_in'] / 60);

            return $body['access_token'];
        } catch (ClientException $e) {
            Log::error("Spotify authentication client error: " . $e->getMessage());
            throw $e;
        } catch (ServerException $e) {
            Log::error("Spotify authentication server error: " . $e->getMessage());
            throw $e;
        } catch (RequestException $e) {
            Log::error("Spotify authentication request error: " . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error("Spotify authentication general error: " . $e->getMessage());
            throw $e;
        }
    }

    public function getTrackDetails($id)
    {
        try {
            $accessToken = $this->authenticate();

            $trackResponse = $this->client->get("tracks/{$id}", [
                'headers' => ['Authorization' => "Bearer {$accessToken}"],
            ]);
            $trackDetails = json_decode($trackResponse->getBody(), true);

            $featuresResponse = $this->client->get("audio-features/{$id}", [
                'headers' => ['Authorization' => "Bearer {$accessToken}"],
            ]);
            $trackFeatures = json_decode($featuresResponse->getBody(), true);

            $artistIds = array_column($trackDetails['artists'], 'id');
            $artistsInfo = $this->getArtistInfo($artistIds);

            $trackInfo = array_merge($trackDetails, ['audio_features' => $trackFeatures, 'artists_info' => $artistsInfo]);

            return view('track-details', ['trackInfo' => $trackInfo]);
        } catch (ClientException $e) {
            Log::error("Spotify get track details client error: " . $e->getMessage());
            return view('errors.general', ['message' => 'Unable to retrieve track details']);
        } catch (ServerException $e) {
            Log::error("Spotify get track details server error: " . $e->getMessage());
            return view('errors.general', ['message' => 'Unable to retrieve track details']);
        } catch (RequestException $e) {
            Log::error("Spotify get track details request error: " . $e->getMessage());
            return view('errors.general', ['message' => 'Unable to retrieve track details']);
        } catch (\Exception $e) {
            Log::error("Spotify get track details general error: " . $e->getMessage());
            return view('errors.general', ['message' => 'Unable to retrieve track details']);
        }
    }

    private function getArtistInfo($artistIds)
    {
        $accessToken = $this->authenticate();
        $artistsInfo = [];

        foreach ($artistIds as $id) {
            $response = $this->client->get("artists/{$id}", [
                'headers' => ['Authorization' => "Bearer {$accessToken}"],
            ]);
            $artistsInfo[] = json_decode($response->getBody(), true);
        }

        return $artistsInfo;
    }
}
