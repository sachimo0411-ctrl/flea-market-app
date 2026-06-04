@extends('layouts.auth')

@section('title', '会員登録')

@section('content')
<div class="auth">
    <div class="auth__content">
        <h2 class="auth__heading">会員登録</h2>

        <form class="form" method="post" action="{{ route('register') }}">
            @csrf

            <div class="form__group">
                <label class="form__label" for="name">ユーザー名</label>
                <input class="form__input" type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form__group">
                <label class="form__label" for="email">メールアドレス</label>
                <input class="form__input" type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form__group">
                <label class="form__label" for="password">パスワード</label>
                <input class="form__input" type="password" name="password" id="password">
                @error('password')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form__group form__group--last">
                <label class="form__label" for="password_confirmation">確認用パスワード</label>
                <input class="form__input" type="password" name="password_confirmation" id="password_confirmation">
                @error('password_confirmation')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">登録する</button>
            </div>
        </form>

        <div class="auth__link">
            <a href="{{ route('login') }}">ログインはこちら</a>
        </div>
    </div>
</div>
@endsection