<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

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

    <p>
        <a href="{{ route('register') }}">新規登録</a>
    </p>
</body>
</html>
