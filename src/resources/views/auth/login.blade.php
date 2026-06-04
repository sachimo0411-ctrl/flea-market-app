@extends('layouts.auth')

@section('title', 'ログイン')

@section('content')
<div class="auth">
    <div class="auth__content">
        <h2 class="auth__heading">ログイン</h2>

        <form class="form" method="post" action="{{ route('login') }}">
        @csrf
            <div class="form__group">
                <label class="form__label" for="email">メールアドレス</label>
                <input class="form__input" type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form__gorp">
                <label class="form__label" for="password">パスワード</label>
                <input class="form__input" type="password" name="password" id="password">
                @error('password')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">ログインする</button>
            </div>
        </form>

        <div class="auth__link">
            <a href="{{ route('register') }}">会員登録はこちら</a>
        </div>
    </div>
</div>
@endsection