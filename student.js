// ページ読み込み後に実行
$(function() {
    console.log('JavaScript読み込みOK');

    /**
     * 検索フォーム送信イベント
     * フォーム送信をAjaxに置き換え
     */
    $('form').on('submit', function(e) {
        e.preventDefault(); // 通常の送信を止める
        console.log('フォーム送信キャンセル&Ajax開始');

        $.ajax({
            url: $(this).attr('action'),
            type: 'GET',
            data: $(this).serialize(), // フォーム入力をシリアライズ
            dataType: 'json'
        })
        .done(function(data) {
            // テーブルHTMLを組み立て
            let tbodyHtml = '';
            if (data.length > 0) {
                $.each(data, function(index, student) {
                    tbodyHtml += `
                        <tr>
                            <td>${student.grade}</td>
                            <td>${student.name}</td>
                            <td>
                                <form method="GET" action="/students/${student.id}">
                                    <button type="submit">表示</button>
                                </form>
                            </td>
                        </tr>
                    `;
                });
            } else {
                tbodyHtml = '<tr><td colspan="3">該当する学生が見つかりませんでした。</td></tr>';
            }

            // テーブルに反映
            $('tbody').html(tbodyHtml);
        })
        .fail(function() {
            alert('通信に失敗しました');
        });
    });

    /**
     * 学年昇順ソートボタン
     */
    $('#sortAsc').on('click', function() {
        fetchStudents('asc');
    });

    /**
     * 学年降順ソートボタン
     */
    $('#sortDesc').on('click', function() {
        fetchStudents('desc');
    });
});

/**
 * ソート用Ajax取得関数
 * @param {string} order 'asc' or 'desc'
 */
function fetchStudents(order) {
    $.ajax({
        url: '/students',
        type: 'GET',
        data: {
            sort: order
        },
        dataType: 'json'
    })
    .done(function(data) {
        // テーブルHTMLを組み立て
        let tbodyHtml = '';
        if (data.length > 0) {
            $.each(data, function(index, student) {
                tbodyHtml += `
                    <tr>
                        <td>${student.grade}</td>
                        <td>${student.name}</td>
                        <td>
                            <form method="GET" action="/students/${student.id}">
                                <button type="submit">表示</button>
                            </form>
                        </td>
                    </tr>
                `;
            });
        } else {
            tbodyHtml = '<tr><td colspan="3">該当する学生が見つかりませんでした。</td></tr>';
        }

        // テーブルに反映
        $('tbody').html(tbodyHtml);
    })
    .fail(function() {
        alert('通信に失敗しました');
    });
}
