<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>学生登録フォーム</title>
</head>
<body>
    <h1>学生登録フォーム</h1>

    <!-- 学生登録フォーム -->
    <form method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data">
        @csrf <!-- CSRFトークン -->

        <!-- 学年入力 -->
        <label>
            学年:
            <input type="text" name="grade" required>
        </label>
        <br>

        <!-- 名前入力 -->
        <label>
            名前:
            <input type="text" name="name" required>
        </label>
        <br>

        <!-- 住所入力 -->
        <label>
            住所:
            <input type="text" name="address">
        </label>
        <br>

        <!-- 顔写真アップロード -->
        <label>
            顔写真:
            <input type="file" name="img_path">
        </label>
        <br>

        <!-- 登録ボタン -->
        <button type="submit">登録</button>
    </form>

    <!-- メニューに戻るリンク -->
    <a href="{{ route('menu') }}">← メニューに戻る</a>
</body>
</html>
