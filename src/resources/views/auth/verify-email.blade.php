@extends('layouts.auth')

@section('title', 'メール認証')

@section('content')
<div class="verify">
    <div class="verify__content">
        <p class="verify__text">
            登録していただいたメールアドレスに認証メールを送付しました。<br>
            メール認証を完了してください。
        </p>

        <a class="verify__button" href="http://localhost:8025" target="_blank">
            認証はこちらから
        </a>

        <form class="verify__form" method="post" action="{{ route('verification.send') }}">
            @csrf
            <button class="verify__resend" type="submit">
                認証メールを再送する
            </button>
        </form>
    </div>
</div>
@endsection