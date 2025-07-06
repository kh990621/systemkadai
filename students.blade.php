<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>学生表示画面</title>
</head>
<body>
    <h1>学生一覧</h1>

    <!-- 検索フォーム -->
    <form method="GET" action="{{ route('students.index') }}">
        <!-- 学年で検索 -->
        <label>学年で検索：</label>
        <select name="grade">
            <option value="">すべて</option>
            @for ($i = 1; $i <= 6; $i++)
                <option value="{{ $i }}" {{ request('grade') == $i ? 'selected' : '' }}>
                    {{ $i }}年
                </option>
            @endfor
        </select>

        <!-- 名前で検索 -->
        <label>名前で検索：</label>
        <input 
            type="text" 
            name="name" 
            value="{{ request('name') }}" 
            placeholder="例：田中"
        />

        <button type="submit">検索</button>
    </form>

    <!-- ソートボタン -->
    <button id="sortAsc">学年昇順</button>
    <button id="sortDesc">学年降順</button>

    <br>

    <!-- 学生リスト -->
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>学年</th>
                <th>名前</th>
                <th>詳細表示</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $student->grade }}</td>
                    <td>{{ $student->name }}</td>
                    <td>
                        <!-- 詳細表示リンク -->
                        <a href="{{ route('students.show', $student->id) }}">表示</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">該当する学生が見つかりませんでした。</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <!-- メニューに戻る -->
    <a href="{{ route('menu') }}">← メニューに戻る</a>

    <!-- jQuery & 学生一覧用スクリプト -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/student.js') }}"></script>
</body>
</html>
