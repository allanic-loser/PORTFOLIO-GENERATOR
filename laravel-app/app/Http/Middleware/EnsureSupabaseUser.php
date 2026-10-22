<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class EnsureSupabaseUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Unauthenticated.',
            ], 401);
        }

        $url = rtrim(config('services.supabase.url'), '/');
        $key = config('services.supabase.key');

        if (!$url || !$key) {
            return response()->json([
                'message' => 'Supabase configuration is missing.',
            ], 500);
        }

        $response = Http::withHeaders([
            'apikey' => $key,
        ])->withToken($token)
          ->acceptJson()
          ->get($url . '/auth/v1/user');

        if (!$response->successful() || !$response->json('id')) {
            return response()->json([
                'message' => 'Invalid or expired Supabase token.',
            ], 401);
        }

        $request->attributes->set(
            'supabase_user_id',
            $response->json('id')
        );

        return $next($request);
    }
}