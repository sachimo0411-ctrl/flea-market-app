@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/items.css') }}">
@endsection

@php
use Illuminate\Support\Str;
@endphp

@section('content')

<div class="item-tabs">
    <a class="item-tabs__link {{ request('tab') !=='mylist' ? 'item-tabs__link--active' : '' }}" href="{{ route('items.index') }}">
        おすすめ
    </a>
    <a class="item-tabs__link {{ request('tab') ==='mylist' ? 'item-tabs__link--active' : '' }}" href="{{ route('items.index', [
        'tab' => 'mylist',
        'keyword' => request('keyword')
    ]) }}">
        マイリスト
    </a>
</div>

<div class="item-list">
    @forelse ($items as $item)
    <a href="{{ route('items.show', $item->id) }}" class="item-card">
        <div class="item-card__image-wrap">
            @if (Str::startsWith($item->image, 'http'))
            <img src="{{ $item->image }}" alt="{{ $item->name }}">
            @else
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="item-card__image">
            @endif

            @if ($item->is_sold)
            <span class="item-card__sold">Sold</span>
            @endif
        </div>

        <p class="item-card__name">{{ $item->name }}</p>
    </a>
    @empty
        @if (request('tab') === 'mylist')
            <p class="item-tab__empty">
                お気に入りした商品はありません
            </p>
        @endif
    @endforelse
</div>
@endsection