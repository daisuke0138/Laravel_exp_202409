<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        // 現在のユーザーを取得
        $user = auth()->user();
        
        // ルートパラメータとして渡されたユーザー情報を使用
        return view('profile.edit', compact('user'));

    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'department' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 画像ファイルのバリデーション
            'number' => 'required|string|max:255|unique:users,number,' . Auth::id(), // 社員番号のバリデーション
            'business_experience' => 'nullable|string', // 業務経験のバリデーション
            'hobby' => 'nullable|string', // 趣味のバリデーション
]);

        $user = Auth::user();

    if ($request->hasFile('profile_image')) {
        // 古い画像を削除する場合
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        // 新しい画像のファイル名を生成
        $extension = $request->file('profile_image')->getClientOriginalExtension();
        $filename = $request->number . '.' . $extension; // ドットを追加

        // 画像を保存
        $imagePath = $request->file('profile_image')->storeAs('profile_images', $filename, 'public');
        $user->profile_image = $imagePath;
        $user->save();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'class' => $request->class,
            'number' => $request->number,
            'hobby' => $request->hobby,
            'business_experience' => $request->business_experience,
        ]);

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function myProfileEdit(User $user)
    {
        // 現在のユーザーを取得
        $user = Auth::user();
        // ルートパラメータとして渡されたユーザー情報を使用
        return view('profile.my-profile-edit', compact('user'));
    }
}
