<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->bearerToken();
            if (!$token) {
                return response()->json([
                    'messages'=>"Unauthenticated.",
                    'reason'=>"missing token"
                ],401);
            }
            $user = Auth::guard('sanctum')->user();
            $tokenModel = $user->currentAccessToken();
            if ($tokenModel->expires_at< Carbon::now()) {
                return response()->json([
                    'messages'=>"Unauthenticated.",
                    'reason'=>"expired token"
                ],401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'messages'=>"Invalid Authentication."
            ],401);
        }
        return $next($request);
    }
}
