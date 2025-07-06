<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>成績登録</title>
</head>
<body>
    <h1>成績登録</h1>

    <form method="POST" action="{{ route('grades.store', $student->id) }}">
        @csrf

        <div>
            <label>学年:</label>
            <select name="grade">
                @for ($i = 1; $i <= 6; $i++)
                    <option value="{{ $i }}">{{ $i }}年</option>
                @endfor
            </select>
        </div>

        <div>
            <label>学期:</label>
            <select name="term">
                <option value="1">1学期</option>
                <option value="2">2学期</option>
                <option value="3">3学期</option>
            </select>
        </div>

        @foreach(['japanese'=>'国語','math'=>'数学','science'=>'理科','social_studies'=>'社会','music'=>'音楽','home_economics'=>'家庭科','english'=>'英語','art'=>'美術','health_and_physical_education'=>'保健体育'] as $field => $label)
            <div>
                <label>{{ $label }}:</label>
                <select name="{{ $field }}">
                    @for($score=1; $score<=5; $score++)
                        <option value="{{ $score }}">{{ $score }}</option>
                    @endfor
                </select>
            </div>
        @endforeach

        <button type="submit">成績登録</button>
    </form>

    <br>
    <a href="{{ route('students.show', $student->id) }}">← 戻る</a>
</body>
</html>
