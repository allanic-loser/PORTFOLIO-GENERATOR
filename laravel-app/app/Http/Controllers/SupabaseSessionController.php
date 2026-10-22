<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SupabaseSessionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'access_token' => ['required', 'string'],
        ]);

        $url = rtrim(config('services.supabase.url', ''), '/');
        $key = config('services.supabase.key');

        if ($url === '' || !$key) {
            return response()->json([
                'message' => 'Supabase configuration is missing.',
            ], 500);
        }

        $response = Http::withHeaders([
            'apikey' => $key,
        ])->withToken($request->input('access_token'))
          ->acceptJson()
          ->get($url . '/auth/v1/user');

        $userId = $response->json('id');

        if (!$response->successful() || !is_string($userId)) {
            return response()->json([
                'message' => 'Invalid or expired Supabase session.',
            ], 401);
        }

        $request->session()->regenerate();
        $request->session()->put('supabase_user_id', $userId);

        return response()->json([
            'message' => 'Supabase session verified.',
        ]);
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('supabase_user_id');

        return response()->json([
            'message' => 'Session cleared.',
        ]);
    }
}
