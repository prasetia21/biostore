<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TokenNinja;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class TokenNinjaController extends Controller
{
    public function generateAccessToken(Request $request)
    {
        $countryCode = env('COUNTRY_CODE');
        $clientId = env('NINJA_CLIENT_ID');
        $clientSecret = env('NINJA_CLIENT_SECRET');

        $client = new Client();

        $token = $this->getAccessToken();

        $expiresAt = $this->getAccessTokenExpiration($token->access_token);
        $bufferTime = 5 * 60; // 5 minutes in seconds

        $expire = strtotime($expiresAt);
        $currentTime = time();

        $timeDiff = $expire - $currentTime;


        if ($timeDiff <= $bufferTime) {

            try {
                $body = [
                    'grant_type' => 'client_credentials',
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                ];

                $response = $client->post('https://api-sandbox.ninjavan.co/' . $countryCode . '/2.0/oauth/access_token', [
                    'form_params' => $body,
                ]);

                return response()->json($response->getBody()->getContents());
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                if ($e->getResponse()->getStatusCode() === 401) {

                    $newToken = $this->generateNewAccessToken($client, $countryCode, $clientId, $clientSecret);

                    TokenNinja::where('id', 1)->update([
                        'access_token' => $newToken['access_token'],
                        'expires' => date('Y-m-d H:i:s', $newToken['expires']),
                        'expires_in' => $newToken['expires_in'],
                        'token_type' => $newToken['token_type'],

                    ]);

                    $token = TokenNinja::where('id', 1)->first();

                    return response()->json([
                        'success' => true,
                        'token' => $token,
                    ]);
                }

                throw $e;
            }

            $newToken = $this->generateNewAccessToken($client, $countryCode, $clientId, $clientSecret);

            TokenNinja::where('id', 1)->update([
                'access_token' => $newToken['access_token'],
                'expires' => date('Y-m-d H:i:s', $newToken['expires']),
                'expires_in' => $newToken['expires_in'],
                'token_type' => $newToken['token_type'],

            ]);

            return response()->json([
                'success' => true,
                'token' => $newToken,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Access token masih aktif.',
            ], 401);
        }
    }

    private function getAccessToken()
    {
        $countryCode = env('COUNTRY_CODE');

        $clientId = env('NINJA_CLIENT_ID');
        $clientSecret = env('NINJA_CLIENT_SECRET');

        $client = new Client();

        $accessToken = TokenNinja::first();

        if ($accessToken == null) {
            $accessToken = $this->generateNewAccessToken($client, $countryCode, $clientId, $clientSecret);

            $accessToken = TokenNinja::create([
                'id' => 1,
                'access_token' => $accessToken['access_token'],
                'expires' => date('Y-m-d H:i:s', $accessToken['expires']),
                'expires_in' => $accessToken['expires_in'],
                'token_type' => 'bearer',
            ]);
        }

        return $accessToken;
    }

    private function getAccessTokenExpiration($token)
    {
        $accessToken = TokenNinja::where('access_token', $token)->first();

        if (!$accessToken) {
            if (empty($token)) {
                return null;
            } else {
                throw new Exception('Access token not found.');
            }
        }

        return $accessToken->expires;
    }

    private function generateNewAccessToken($client, $countryCode, $clientId, $clientSecret)
    {
        $body = [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ];

        $response = $client->post('https://api-sandbox.ninjavan.co/' . $countryCode . '/2.0/oauth/access_token', [
            'form_params' => $body,
        ]);

        $data = json_decode((string) $response->getBody(), true);
        return $data;
    }

    private function revokeAccessToken($token)
    {
        $accessToken = TokenNinja::where('access_token', $token->access_token)->first();

        if ($accessToken) {
            $accessToken->delete();
        }
    }
}
