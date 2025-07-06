// ページ読み込み後に実行
$(function() {
    /**
     * 成績検索フォーム送信イベント
     */
    $('#gradeSearchForm').on('submit', function(e) {
        e.preventDefault(); // フォーム送信を止める

        $.ajax({
            // 学生IDをURLに含める
            url: '/students/' + STUDENT_ID + '/grades',
            type: 'GET',
            data: $(this).serialize(), // フォームデータをクエリに変換
            dataType: 'json'
        })
        .done(function(data) {
            if (data) {
                // 成績情報HTMLを組み立て
                let html = `
                    <ul>
                        <li>国語：${data.japanese}</li>
                        <li>数学：${data.math}</li>
                        <li>理科：${data.science}</li>
                        <li>社会：${data.social_studies}</li>
                        <li>音楽：${data.music}</li>
                        <li>家庭科：${data.home_economics}</li>
                        <li>英語：${data.english}</li>
                        <li>美術：${data.art}</li>
                        <li>保健体育：${data.health_and_physical_education}</li>
                    </ul>
                `;
                $('#gradeResult').html(html);
            } else {
                // データがない場合
                $('#gradeResult').html('<p>該当する成績がありません。</p>');
            }
        })
        .fail(function() {
            // 通信エラー
            alert('成績の取得に失敗しました');
        });
    });
});
