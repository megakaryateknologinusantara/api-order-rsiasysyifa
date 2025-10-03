<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenExpiryMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->user()?->currentAccessToken();

        if ($token) {
            $createdTime = strtotime($token->created_at);
            $now = time();

            $diffInMinutes = ($now - $createdTime) / 60;

            if ($diffInMinutes >= 30) {
                $token->delete(); // hapus token biar gak dipakai lagi

                return response()->json([
                    'status' => false,
                    'code' => 401,
                    'message' => 'Token telah expired, silakan login kembali',
                    'data' => null
                ], 401);
            }
        }

        return $next($request);
    }
}
