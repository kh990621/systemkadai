<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>

 <!-- バリデーションエラーがある場合、一覧表示 -->
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

 <!-- ログイン後などに表示する成功メッセージ -->
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

 <!-- ログインフォーム -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label>メールアドレス</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>パスワード</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">ログイン</button>
    </form>

<!-- 新規登録リンク -->
    <p>
        <a href="{{ route('register') }}">新規登録</a>
    </p>
</body>
</html>
