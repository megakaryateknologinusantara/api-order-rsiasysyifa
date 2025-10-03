<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if ($request->is('api/*')) {
            abort(response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Token tidak valid atau telah expired',
                'data' => null
            ], 401));
        }

        return route('login');
    }
}
