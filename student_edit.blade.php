<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>学生編集</title>
</head>
<body>
    <h1>学生編集</h1>

    <!-- 学生編集フォーム -->
    <form method="POST" action="{{ route('students.update', $student->id) }}">
        @csrf
        @method('PUT') <!-- PUTメソッドを指定 -->
        

        <!-- 学年入力 -->
        <label>
            学年：
            <input type="text" name="grade" value="{{ old('grade', $student->grade) }}">
        </label>
        <br>

        <!-- 名前入力 -->
        <label>
            名前：
            <input type="text" name="name" value="{{ old('name', $student->name) }}">
        </label>
        <br>

        <!-- 住所入力 -->
        <label>
            住所：
            <input type="text" name="address" value="{{ old('address', $student->address) }}">
        </label>
        <br>

        <!-- コメント入力 -->
        <label>
            コメント：
            <textarea name="comment">{{ old('comment', $student->comment) }}</textarea>
        </label>
        <br>

        <!-- 更新ボタン -->
        <button type="submit">更新</button>
    </form>

    <!-- 戻るリンク -->
    <a href="{{ route('students.show', $student->id) }}">← 戻る</a>
</body>
</html>
