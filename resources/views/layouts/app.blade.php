<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Icons -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/favicon.png') }}" sizes="180x180">
</head>
<body>
    <div id="app">
        <header>
            <h1 class="header-title">
                <a href="{{ url('/') }}">Tastitt</a>
            </h1>
            <div class="header-icon">
                <a id="logout" class="logout-link" href="javascript:;" onclick="displayControll('logout-form')"><span id="link-logout-triangle"></span>{{ Auth::user()->name }}</a>
                <form id="logout-form" class="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" style="display: none">
                    @csrf
                    <input type="submit" value="ログアウト">
                </form>
            </div>
        </header>

        <main class="py-4">
            @yield('content')
        </main>

        <footer>
            <nav>
                <ul class="footer-nav">
                    <li></li>
                </ul>
            </nav>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/style.js') }}"></script>
</body>
</html>
