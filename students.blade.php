<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>学生表示画面</title>
</head>
<body>
    <h1>学生一覧</h1>

    {{-- 検索フォーム --}}
    <form method="GET" action="{{ route('students.index') }}">
        <label>学年で検索：</label>
        <select name="grade">
            <option value="">すべて</option>
            @for ($i = 1; $i <= 6; $i++)
                <option value="{{ $i }}" {{ request('grade') == $i ? 'selected' : '' }}>{{ $i }}年</option>
            @endfor
        </select>

        <label>名前で検索：</label>
        <input 
            type="text" 
            name="name" 
            value="{{ request('name') }}" 
            placeholder="例：田中"
        />
        
        <button type="submit">検索</button>
    </form>

    <br>

    {{-- 学生リスト --}}
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
                        <form method="GET" action="{{ route('students.show', $student->id) }}">
                            <button type="submit">表示</button>
                        </form>
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
    <a href="{{ route('menu') }}">← メニューに戻る</a>
    </body>
</html>
