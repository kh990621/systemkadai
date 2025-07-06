<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ユーザーモデルを忘れずに！
use Illuminate\Support\Facades\Hash; // パスワードハッシュ用
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('register'); // resources/views/register.blade.php
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'user_name' => $validated['user_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect('/login')->with('success', 'ユーザー登録が完了しました');
    }


    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('menu'); // ✅ ここでメニュー画面へ遷移！
    }

    return back()->withErrors([
        'email' => 'メールアドレスまたはパスワードが正しくありません。',
    ])->onlyInput('email');
}
}



     