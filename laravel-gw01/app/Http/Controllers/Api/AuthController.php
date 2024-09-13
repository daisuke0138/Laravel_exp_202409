<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Auth;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8',
    ]);

    $user = User::create([
      'name' => $validatedData['name'],
      'email' => $validatedData['email'],
      'password' => Hash::make($validatedData['password']),
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
      'access_token' => $token,
      'token_type' => 'Bearer',
    ]);
  }
public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['message' => 'Successfully logged in', 'user' => $user, 'token' => $token]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


    public function logout(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $user->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}


