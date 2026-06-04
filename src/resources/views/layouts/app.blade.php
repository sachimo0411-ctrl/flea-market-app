<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/address.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a href="{{ route('items.index') }}">
                <img src="{{ asset('img/logo.png') }}" alt="COACHTECH" class="header__logo">
            </a>

            <div class="header__search">
                <form action="{{ route('items.index') }}" method="get">
                    <input class="header__search-input" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="なにをお探しですか？">
                    <button type="submit" class="header__search-button">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            <nav class="header__nav">
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>

                <a href="{{ route('profile.index') }}">マイページ</a>

                <a href="{{ route('sell.create') }}" class="header__button">出品</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>