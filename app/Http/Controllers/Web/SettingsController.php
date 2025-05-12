<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Livewire\Attributes\Validate;

class SettingsController extends Controller
{
    public function settings()
    {
        $auth = Auth::user();
        $all_token = $auth->tokens()->orderBy('id', 'DESC')->get();
        return view('settings', compact('all_token'));
    }

    public function generateApiKey(Request $request): JsonResponse
    {
        $auth = Auth::user();
        $validate = $request->validate(
            [
                'apikeyname' => 'required|string|max:255'
            ],
            [
                'apikeyname.required' => 'Please enter an API key name.',
                'apikeyname.max' => 'The API key name must not exceed 115 characters.'
            ]
        );
        try {
            $name = $request['apikeyname'];

            $tokenCount = $auth->tokens()->count();
            if ($tokenCount >= 3) {
                return response()->json(['status' => 'error', 'message' => 'You have reached the maximum limit of 3 API keys.'], 403);
            }
            $token = $auth->createToken($name . '-Auth-Token')->plainTextToken;
            return response()->json(['status' => 'success', 'message' => 'Api key successfully created', 'token' => $token], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 200);
        }
    }

    public function revokeApiToken(Request $request): JsonResponse
    {
        $auth = Auth::user();
        $validate = $request->validate([
            'revokeAPITokenid' => 'required|integer',
        ]);
        try {
            $token = PersonalAccessToken::find($request->revokeAPITokenid);
            if ($token && $token->tokenable_id === $auth->id) {
                $token->delete();
                return response()->json(['status' => 'success', 'message' => 'Token Successfully Revoked'], 200);
            }
            return response()->json(['status' => 'error', 'message' => 'Token not found or unauthorized'], 500);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Internal Server Error'], 500);
        }
    }
}
