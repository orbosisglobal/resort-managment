<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\PersonalAccessToken;

class ValidateAuthToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $plainTextToken = $request->bearerToken();

        
        $token = PersonalAccessToken::findToken($plainTextToken);
        
        if (!$token || ($token->expires_at && $token->expires_at->isPast())) {
            return response()->json([
                'status' => 1,
                'msg' => config('error-codes.unauthorized_token.message'),
                'error_code' => config('error-codes.unauthorized_token.code'),
                'data' => null,
            ]);
        }

        $user = $token->tokenable; 
        if (!$user) {
            return response()->json([
                'status' => 1,
                'msg' => config('error-codes.unauthorized_user.message'),
                'error_code' => config('error-codes.unauthorized_user.code'),
                'data' => null,
            ]);
        }

        
        auth()->login($user);

        return $next($request);
    }
}
