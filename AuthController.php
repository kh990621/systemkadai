<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ユーザーモデル
use Illuminate\Support\Facades\Hash; // パスワードハッシュ
use Illuminate\Support\Facades\Auth; // 認証

/**
 * 認証コントローラ
 * ユーザー登録・ログイン処理
 */
class AuthController extends Controller
{
    /**
     * ユーザー登録フォーム表示
     */
    public function showRegisterForm()
    {
        return view('register'); // resources/views/register.blade.php
    }

    /**
     * ログインフォーム表示
     */
    public function showLoginForm()
    {
        return view('login'); // resources/views/login.blade.php
    }

    /**
     * ユーザー登録処理
     */
    public function register(Request $request)
    {
        // 入力バリデーション
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // ユーザー作成
        User::create([
            'user_name' => $validated['user_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // ハッシュ化
        ]);

        // ログイン画面へリダイレクト
        return redirect('/login')
            ->with('success', 'ユーザー登録が完了しました');
    }

    /**
     * ログイン処理
     */
    public function login(Request $request)
    {
        // 入力バリデーション
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 認証試行
        if (Auth::attempt($credentials)) {
            // セッションID再生成
            $request->session()->regenerate();

            // メニュー画面へリダイレクト
            return redirect()->route('menu');
        }

        // 認証失敗時
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('email');
    }
}
