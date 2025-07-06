<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>成績編集画面</title>
</head>
<body>
    <h1>成績編集</h1>

    <form method="POST" action="{{ route('grades.update', $grade->id) }}">

        @csrf
        @method('PUT')

        <label>学年：</label>
        <select name="grade">
            @for ($i = 1; $i <= 6; $i++)
                <option value="{{ $i }}" {{ old('grade', $grade->grade) == $i ? 'selected' : '' }}>
                    {{ $i }}年
                </option>
            @endfor
        </select>
        <br>

        <label>学期：</label>
        <select name="term">
            @for ($i = 1; $i <= 3; $i++)
                <option value="{{ $i }}" {{ old('term', $grade->term) == $i ? 'selected' : '' }}>
                    第{{ $i }}学期
                </option>
            @endfor
        </select>
        <br>

        @foreach ([
            'japanese' => '国語',
            'math' => '数学',
            'science' => '理科',
            'social_studies' => '社会',
            'music' => '音楽',
            'home_economics' => '家庭科',
            'english' => '英語',
            'art' => '美術',
            'health_and_physical_education' => '保健体育'
        ] as $field => $label)
            <label>{{ $label }}：</label>
            <select name="{{ $field }}">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old($field, $grade->$field) == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
            <br>
        @endforeach

        <button type="submit">編集</button>
    </form>

    <br>
    <a href="{{ route('students.show', $grade->student_id) }}">← 戻る</a>
</body>
</html>
