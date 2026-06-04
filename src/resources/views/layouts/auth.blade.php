<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/verify.css') }}">

</head>
<body>
    <header class="auth-header">
        <img src="{{ asset('img/logo.png') }}" alt="COACHTECH" class="auth-header__logo">
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>