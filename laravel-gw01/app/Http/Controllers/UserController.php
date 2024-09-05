<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // 全ユーザー情報を取得
        $users = User::all();

        // ビューにユーザー情報を渡す
        return view('users.index', compact('users'));
    }

        public function show(User $user)
    {
        // 特定のユーザー情報を取得
        return view('users.show', compact('user'));
    }
}
