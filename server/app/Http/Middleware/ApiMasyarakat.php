<?php

namespace App\Http\Middleware;

use App\Models\Masyarakat;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class ApiMasyarakat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $plainToken = $request->bearerToken();

        if (!$plainToken) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        if (!str_contains($plainToken, '|')) {
            return response()->json(['message' => 'Invalid token format.'], 401);
        }

        [$id, $token] = explode('|', $plainToken, 2);

        $accessToken = PersonalAccessToken::find($id);

        if (!$accessToken || !hash_equals($accessToken->token, hash('sha256', $token))) {
            return response()->json(['message' => 'Invalid or expired token.'], 401);
        }

        $masyarakat = Masyarakat::find($accessToken->tokenable_id);

        if (!$masyarakat) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $request->masyarakat = $masyarakat;
        return $next($request);
    }
}
