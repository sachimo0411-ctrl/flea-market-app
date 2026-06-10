@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<main class="profile-page">
    <div class="profile-page__inner">

        <section class="profile-page__user">
            <div class="profile-page__image">
                @if ($user->profile_image)
                <img class="profile-page__preview" src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像">
                @endif
            </div>

            <h2 class="profile-page__name">{{ $user->name }}</h2>

            <a class="profile-page__edit-button" href="{{ route('profile.edit') }}">
                プロフィールを編集
            </a>
        </section>

        <div class="profile-page__tabs">
            <a class="profile-page__tab {{ request('page') !=='buy' ? 'profile-page__tab--active' : '' }}" href="{{ route('profile.index', ['page' => 'sell']) }}">
                出品した商品
            </a>
            <a class="profile-page__tab {{ request('page') ==='buy' ? 'profile-page__tab--active' : '' }}" href="{{ route('profile.index', ['page' => 'buy' ]) }}">
                購入した商品
            </a>
        </div>

        <section class="profile-page__items">
            @forelse ($items as $item)
                <a class="profile-page__item" href="{{ route('items.show', $item->id) }}">
                    <div class="profile-page__item-image">
                        @if (Str::startsWith($item->image, 'http'))
                            <img src="{{ $item->image }}" alt="{{ $item->name }}">
                        @else
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                        @endif
                        
                        @if ($item->is_sold)
                        <span class="profile-page__sold">SOLD</span>
                        @endif
                    </div>

                    <p class="profile-page__item-name">
                        {{ $item->name }}
                    </p>
                </a>
            @empty
                @if (request('page') === 'buy')
                    <p class="profile-page__empty">
                        購入した商品はありません
                    </p>
                @else
                    <p class="profile-page__empty">
                        出品した商品はありません
                    </p>
                @endif
            @endforelse
        </section>
    </div>
</main>
@endsection