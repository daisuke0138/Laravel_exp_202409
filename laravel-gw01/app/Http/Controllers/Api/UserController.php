<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ユーザー情報の更新
    public function updateUser(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
            'department' => 'sometimes|required|string|max:255',
            'class' => 'sometimes|required|string|max:255',
            'profile_image' => 'sometimes|required|string|max:255',
            'number' => 'sometimes|required|string|max:255',
            'hobby' => 'sometimes|required|string|max:255',
            'business_experience' => 'sometimes|required|string|max:255',
        ]);

        \Log::info('Validated Data:', $validatedData);

        if (isset($validatedData['name'])) {
            $user->name = $validatedData['name'];
        }
        if (isset($validatedData['email'])) {
            $user->email = $validatedData['email'];
        }
        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        if (isset($validatedData['department'])) {
            $user->department = $validatedData['department'];
        }
        if (isset($validatedData['class'])) {
            $user->class = $validatedData['class'];
        }
        if (isset($validatedData['profile_image'])) {
            $user->profile_image = $validatedData['profile_image'];
        }
        if (isset($validatedData['number'])) {
            $user->number = $validatedData['number'];
        }
        if (isset($validatedData['hobby'])) {
            $user->hobby = $validatedData['hobby'];
        }
        if (isset($validatedData['business_experience'])) {
            $user->business_experience = $validatedData['business_experience'];
        }

        $user->save();

        return response()->json(['user' => $user]);
    }

    public function index(Request $request)
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    public function getUser(Request $request)
    {
        $user = Auth::user();
        return response()->json(['user' => $user]);
    }
}