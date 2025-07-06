<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>学生登録フォーム</title>
</head>
<body>
    <h1>学生登録フォーム</h1>
    <form method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data">
        @csrf
        <label>学年: <input type="text" name="grade" required></label><br>
        <label>名前: <input type="text" name="name" required></label><br>
        <label>住所: <input type="text" name="address"></label><br>
        <label>顔写真: <input type="file" name="img_path"></label><br>
       

        <button type="submit">登録</button>
    </form>

    <a href="{{ route('menu') }}">← メニューに戻る</a>
</body>
</html>
