<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メニュー画面</title>
</head>
<body>
    <h1>メニュー</h1>

    <!-- 学年更新フォーム -->
    <form action="{{ route('student.grade.up') }}" method="POST">
        @csrf <!-- CSRFトークン -->
        <button>学年更新</button>
    </form>

    <!-- 学生登録画面への遷移フォーム -->
    <form action="{{ route('student.register') }}" method="GET">
        <button>学生登録</button>
    </form>

    <!-- 学生一覧表示画面への遷移フォーム -->
    <form action="{{ route('students.index') }}" method="GET">
        <button>学生表示</button>
    </form>
</body>
</html>
