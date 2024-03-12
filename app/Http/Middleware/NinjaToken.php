<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\TokenNinja;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class NinjaToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken(); // Retrieve token from request header

        if (is_null($token)) {


            $token = TokenNinja::where('id', 1)->get();

            if (!$token->isEmpty()) {
                $token = $token[0]->access_token;
    
            } else {
                $token = $this->generateNewToken();
        
            }
        } else {
            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token not provided.'
                ], 401);
            }
        }

        $tokenData = TokenNinja::where('access_token', $token)->first();
      

        if (!$tokenData) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token.'
            ], 401);
        }



        $carbon = Carbon::parse($tokenData->expires);

        // Get the timestamp from the Carbon object
        $timestamp = $carbon->timestamp;



        $bufferTime = 5 * 60; // 5 minutes in seconds
        $currentTime = time();

        // Generate new token if the current token is close to expiring
        if (($timestamp - $currentTime) <= $bufferTime) {
            $this->regenerateToken($tokenData);
        }

        $request->merge(["token" => $tokenData]);

        return $next($request);
    }

    private function regenerateToken($tokenData)
    {
        $countryCode = env('COUNTRY_CODE');
        $clientId = env('NINJA_CLIENT_ID');
        $clientSecret = env('NINJA_CLIENT_SECRET');

        $client = new Client();

        $body = [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ];

        $response = $client->post('https://api-sandbox.ninjavan.co/' . $countryCode . '/2.0/oauth/access_token', [
            'form_params' => $body,
        ]);

        $data = json_decode((string) $response->getBody(), true);

        $tokenData->update([
            'access_token' => $data['access_token'],
            'expires' => date('Y-m-d H:i:s', $data['expires']),
            'expires_in' => $data['expires_in'],
            'token_type' => 'bearer',
        ]);
    }

    private function generateNewToken()
    {
        $countryCode = env('COUNTRY_CODE');
        $clientId = env('NINJA_CLIENT_ID');
        $clientSecret = env('NINJA_CLIENT_SECRET');

        $client = new Client();

        $body = [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ];

        $response = $client->post('https://api-sandbox.ninjavan.co/' . $countryCode . '/2.0/oauth/access_token', [
            'form_params' => $body,
        ]);

        $data = json_decode((string) $response->getBody(), true);

        $token = TokenNinja::create([
            'id' => 1,
            'access_token' => $data['access_token'],
            'expires' => date('Y-m-d H:i:s', $data['expires']),
            'expires_in' => $data['expires_in'],
            'token_type' => 'bearer',
        ]);

        return $token;
    }
}
