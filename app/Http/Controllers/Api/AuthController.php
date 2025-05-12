<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login (Request $request) : JsonResponse 
    {
        $request->validate([
            'email'    => 'required|email|min:8|max:255',
            'password' => 'required|string|min:8|max:255'
        ]);
        
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['status' => 'error', 'message' => 'Incorrect Credentials'], 401);
            }

            $token = $user->createToken($user->name.'Auth-Token')->plainTextToken;



            return response()->json(['message' => 'Successfully logged in', 'token_type' => 'Bearer', 'token' => $token], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function register (Request $request) : JsonResponse 
    { 
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|min:8|max:255',
            'password' => 'required|string|min:8|max:255'
        ]);
        try { 
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($user) {

                $token = $user->createToken($user->name.'Auth-Token')->plainTextToken;
                return response()->json(['message' => 'Registration Successfull', 'token_type' => 'Bearer', 'token' => $token], 201);

            } else {
                return response()->json(['message' => 'Something went wrong'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
