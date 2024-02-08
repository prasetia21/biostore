<?php

namespace App\Http\Middleware;

use App\Models\TokenNinja;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        if (empty($token)) {
            return response()->json([
                'error' => 'Authorization Header is empty'
            ], 401);
        }

        //format bearer token : 
        //Bearer[spasi]randomhashtoken 
        $exp_token = explode(" ", $token);
        if (count($exp_token) <> 2) {
            return response()->json([
                'error' => 'Invalid Authorization format'
            ], 401);
        }

        if (trim($exp_token[0]) <> 'Bearer') {
            return response()->json([
                'error' => 'Authorization header must be a Bearer'
            ], 401);
        }


        $access_token = trim($exp_token[1]);

        //cek apakah access_token ini ada di database atau tidak
        $cek = TokenNinja::where('access_token', $access_token)->first();
        if (empty($cek)) {
            return response()->json([
                'error' => 'Forbidden : Invalid access token'
            ], 401);
        }

        //cek apakah access_token expired atau tidak
        // if(strtotime($cek->expired_at) < time() || $cek->is_active != 1){
        //     return response()->json([
        //         'error' => 'Forbidden : Token is already expired. '
        //     ], 401);
        // }

        if (strtotime($cek->expired_at) < time() || $cek->is_active != 1) {
            $newToken = $this->generateToken($request->user()->id); // Panggil metode generateToken

            return response()->json([
                'success' => true,
                'token' => $newToken,
                'expires_at' => $cek->expired_at,
            ]);
        }

        //jika semua kondisi dipenuhi, lanjutkan request
        return $next($request);
    }

    protected function generateToken($user_id)
    {
        $token = getNinjaToken();
        $expired_at = now()->addMinutes(5);  // Set masa berlaku token 1 Jam

        TokenNinja::where('user_id', $user_id)
            ->update([
                'access_token' => $token->access_token,
                'expires' => $token->expires,
                'expires_in' => $expired_at,
                'token_type' => 'bearer',
                'expired_at' => $expired_at,
                'is_active' => 1,
            ]);

        return $token;
    }
}
