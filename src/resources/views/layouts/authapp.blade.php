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
    <script></script>
    <script></script>
</body>

</html>