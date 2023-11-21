<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/authapp.css') }}">
    <title>Document</title>
    @yield('css')
</head>

<body class="body">
    <header class="header-area">
        <p class="header-ttl">FashionablyLate</p>
        <div class="link-area">
            @yield('header')
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>
    <script>
        document.getElementById('exportCsvButton').addEventListener('click', function() {
            exportCsv();
        });

        function exportCsv() {
            // ここでCSVエクスポートのための処理を実装
            // Ajaxを使用してサーバーにリクエストを送り、CSVを生成して返す
            // 生成されたCSVをダウンロードさせるなどの処理を行う
            // 以下はサーバーへのAjaxリクエストの例
            axios.post('/export-csv', {
                    /* 任意のデータ */ })
                .then(response => {
                    // エクスポート成功時の処理
                    // 例えば、サーバーから生成されたCSVのダウンロードリンクを処理する
                })
                .catch(error => {
                    // エクスポート失敗時の処理
                });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{asset('js/modal.js')}}"></script>
</body>

</html>