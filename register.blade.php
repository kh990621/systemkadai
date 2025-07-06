<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理ユーザー登録</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">管理ユーザー登録</h1>

        <!-- バリデーションエラー表示 -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 管理ユーザー登録フォーム -->
        <form action="{{ route('admin.register.submit') }}" method="POST">
            @csrf <!-- CSRFトークン -->

            <!-- ユーザー名入力 -->
            <div class="mb-3">
                <label for="username" class="form-label">ユーザー名</label>
                <input type="text" name="user_name" id="username" class="form-control" required>
            </div>

            <!-- メールアドレス入力 -->
            <div class="mb-3">
                <label for="email" class="form-label">Eメール</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <!-- パスワード入力 -->
            <div class="mb-3">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <!-- パスワード確認入力 -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">パスワード確認</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <!-- 登録ボタン -->
            <button type="submit" class="btn btn-primary">登録</button>
        </form>

        <!-- トップページへのリンク -->
        <div class="mt-3">
            <a href="{{ route('home') }}" class="btn btn-secondary">トップページに戻る</a>
        </div>
    </div>
</body>
</html>
