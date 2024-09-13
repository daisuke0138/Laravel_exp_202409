<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function updateUser(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        // dd($user);
        
        // バリデーション
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
            'department' => 'sometimes|nullable|string|max:255',
            'class' => 'sometimes|nullable|string|max:255',
            'profile_image' => 'sometimes|nullable|string|max:255',
            'number' => 'sometimes|nullable|string|max:255',
            'hobby' => 'sometimes|nullable|string|max:255',
            'business_experience' => 'sometimes|nullable|string|max:255',
        ]);

        \Log::info('Request Data: ', $request->all());

        // ユーザー情報の更新
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


        try {
            $user->save();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update user'], 500);
        }

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
        // デバッグのためにユーザー情報をダンプ
        // dd($user);
        return response()->json(['user' => $user]);
    }
}