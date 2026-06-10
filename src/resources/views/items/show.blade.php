@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="item-detail">
    <div class="item-detail__image__area">
        @if (Str::startsWith($item->image, 'http'))
        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="item-detail__image">
        @else
            <img src=" {{ asset('storage/' .$item->image) }}" alt="{{ $item->name }}" class="item-detail__image">
        @endif
    </div>

    <div class="item-detail__content">
        <h1 class="item-detail__name">{{ $item->name }}</h1>
        <p class="item-detail__brand">{{ $item->brand }}</p>
        <p class="item-detail__price">¥{{ number_format($item->price) }}<span>(税込)</span></p>

        <div class="item-detail__actions">
            <div class="item-detail__action">
                <form method="post" action="{{ route('items.like', $item->id) }}">
                    @csrf
                    <button type="submit" class="item-detail__like-button">
                        @if ($item->likes->contains('user_id', auth()->id()))
                        <i class="fa-solid fa-heart liked"></i>
                        @else
                        <i class="fa-regular fa-heart"></i>
                        @endif
                    </button>
                </form>
                <p>{{ $item->likes->count() }}</p>
            </div>
            <div class="item-detail__action item-detail__comment">
                <i class="fa-regular fa-comment"></i>
                <p>{{ $item->comments->count() }}</p>
            </div>
        </div>

        @if ($item->is_sold)
        <button class="item-detail__purchase" disabled>SOLD OUT</button>
        @else
        <a class="item-detail__purchase" href="{{ route('purchase.index', $item->id) }}">購入手続きへ</a>
        @endif

        <section class="item-detail__section">
            <h2>商品説明</h2>
            <p>{{ $item->description }}</p>
        </section>

        <section class="item-detail__section">
            <h2>商品の情報</h2>
            <div class="item-detail__info-row">
                <span class="item-detail__info-label">カテゴリー</span>
                <div class="item-detail__categories">
                    @foreach ($item->categories as $category)
                    <span class="item-detail__tag">
                        {{ $category->name }}
                    </span>
                    @endforeach
                </div>
            </div>
            <div class="item-detail__info-row">
                <span class="item-detail__info-label">商品の状態</span>
                <span>{{ $item->condition }}</span>
            </div>
        </section>

        <section class="item-detail__section">
            <div class="item-detail__comments">
                <h2>コメント({{ $item->comments->count() }})</h2>
                @if ($item->comments->isEmpty())
                <p>まだコメントはありません</p>
                @else
                @foreach ($item->comments->sortByDesc('created_at') as $comment)
                <div class="item-detail__comment-user">
                    <div class="item-detail__avatar"></div>
                    <span>{{ $comment->user->name }}</span>
                </div>
                <div class="item-detail__comment-box">{{ $comment->content }}
                </div>
                @endforeach
                @endif

                <h3 class="item-detail__comment-title">商品へのコメント</h3>
                <form method="post" action="{{ route('items.comment', $item->id) }}">
                    @csrf
                    <textarea name="comment" class="item-detail__textarea"></textarea>

                    @error('comment')
                    <p class="form__error">
                        {{ $message }}
                    </p>
                    @enderror

                    <button class="item-detail__comment-button" type="submit"
                        @if ($item->is_sold) disabled @endif>
                        コメントを送信する
                    </button>
                </form>
        </section>
    </div>
</div>
@endsection