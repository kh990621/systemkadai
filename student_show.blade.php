<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>学生詳細画面</title>
</head>
<body>
    <h1>学生詳細</h1>

    <!-- 基本情報 -->
    <h2>基本情報</h2>
    <p>学年：{{ $student->grade }}</p>
    <p>名前：{{ $student->name }}</p>
    <p>住所：{{ $student->address }}</p>

    @if ($student->img_path)
        <!-- 顔写真 -->
        <p>顔写真：<br>
            <img src="{{ asset('storage/' . $student->img_path) }}" alt="顔写真" width="150">
        </p>
    @endif

    <p>コメント：{{ $student->comment }}</p>

    <!-- 成績情報 -->
    <h2>成績情報</h2>
    <div id="gradeResult">
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
    </div>

    <!-- 成績検索フォーム (Ajaxで切り替え) -->
    <form id="gradeSearchForm">
        <label>学年:</label>
        <select name="grade">
            <option value="">全て</option>
            @for ($i = 1; $i <= 6; $i++)
                <option value="{{ $i }}" {{ request('grade') == $i ? 'selected' : '' }}>
                    {{ $i }}年
                </option>
            @endfor
        </select>

        <label>学期:</label>
        <select name="term">
            <option value="">全て</option>
            <option value="1" {{ request('term') == '1' ? 'selected' : '' }}>1学期</option>
            <option value="2" {{ request('term') == '2' ? 'selected' : '' }}>2学期</option>
            <option value="3" {{ request('term') == '3' ? 'selected' : '' }}>3学期</option>
        </select>

        <button type="submit">検索</button>
    </form>

    <br>

    <!-- 学生編集・成績登録・成績編集・戻るリンク -->
    <a href="{{ route('students.edit', $student->id) }}">学生編集</a> |
    <a href="{{ route('grades.create', $student->id) }}">成績登録</a>
    @if ($grades)
        | <a href="{{ route('grades.edit', $grades->id) }}">成績編集</a>
    @endif
    | <a href="{{ route('students.index') }}">← 戻る</a>

    <!-- 学生削除フォーム -->
    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('本当に削除しますか？')">学生削除</button>
    </form>

    <!-- Ajaxで成績を取得するための学生ID -->
    <script>
        const STUDENT_ID = {{ $student->id }};
    </script>

    <!-- jQuery & Ajaxスクリプト -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/student_show.js') }}"></script>
</body>
</html>
