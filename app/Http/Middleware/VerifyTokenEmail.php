<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class VerifyTokenEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $email = $request->input('email'); // Assuming email is in the request body

        if (!$token || !$email) {
            return response()->json(['message' => 'Token and Email are required.'], 400);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            return response()->json(['message' => 'Invalid Token.'], 401);
        }

        $user = User::find($personalAccessToken->tokenable_id);

        if (!$user || $user->email !== $email) {
            return response()->json(['message' => 'Token and Email Mismatch.'], 401);
        }

        $request->setUserResolver(function () use ($user) {
            return $user;
        });
        return $next($request);
    }
}
