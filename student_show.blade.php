<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>学生詳細画面</title>
</head>
<body>
    <h1>学生詳細</h1>

    <h2>基本情報</h2>
    <p>学年：{{ $student->grade }}</p>
    <p>名前：{{ $student->name }}</p>
    <p>住所：{{ $student->address }}</p>

    @if ($student->img_path)
        <p>顔写真：<br><img src="{{ asset('storage/' . $student->img_path) }}" alt="顔写真" width="150"></p>
    @endif

    <p>コメント：{{ $student->comment }}</p>

    <h2>成績情報</h2>
    @if ($grades)
        <ul>
            <li>国語：{{ $grades->japanese }}</li>
            <li>数学：{{ $grades->math }}</li>
            <li>理科：{{ $grades->science }}</li>
            <li>社会：{{ $grades->social_studies }}</li>
            <li>音楽：{{ $grades->music }}</li>
            <li>家庭科：{{ $grades->home_economics }}</li>
            <li>英語：{{ $grades->english }}</li>
            <li>美術：{{ $grades->art }}</li>
            <li>保健体育：{{ $grades->health_and_physical_education }}</li>
        </ul>
    @else
        <p>成績情報が登録されていません。</p>
    @endif

    <br>
<a href="{{ route('students.edit', $student->id) }}">学生編集</a> |
<a href="{{ route('grades.create', $student->id) }}">成績登録</a>
@if ($grades)
    | <a href="{{ route('grades.edit', $grades->id) }}">成績編集</a>
@endif<a href="{{ route('students.index') }}">← 戻る</a>

<form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('本当に削除しますか？')">学生削除</button>
</form>


</body>
</html>
