@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<form method="post" action="{{ route('purchase.store', $item->id) }}" class="purchase-form">
    @csrf

    <div class="purchase">
        <div class="purchase__main">
            <div class="purchase__item">
                <img src="{{ $item->image }}" alt="{{ $item->name }}" class="purchase__item-image">

                <div class="purchase__item-info">
                    <h1 class="purchase__item-name">{{ $item->name }}</h1>
                    <p class="purchase__item-price">¥{{ number_format($item->price) }}</p>
                </div>
            </div>

            <section class="purchase__section">
                <h2 class="purchase__section-title">支払い方法</h2>

                <select name="payment_method" id="payment_method" class="purchase__select">
                    <option selected disabled>選択してください</option>
                    <option value="コンビニ払い">コンビニ払い</option>
                    <option value="カード払い">カード払い</option>
                </select>

                @error('payment_method')
                <p class="form__error">
                    {{ $message }}
                </p>
                @enderror
            </section>

            <section class="purchase__section">
                <div class="purchase__section-head">
                    <h2 class="purchase__section-title">配送先</h2>
                    <a href="{{ route('address.edit', $item->id) }}" class="purchase__change-link">変更する</a>
                </div>

                <div class="purchase__address">
                    <p>〒 {{ $user->postal_code }}</p>
                    <p>{{ $user->address }} {{ $user->building_name }}</p>
                </div>

                <input type="hidden" name="address" value="{{ $user->address }}">

                @error('address')
                <p class="form__error">
                    {{ $message }}
                </p>
                @enderror
            </section>
        </div>

        <aside class="purchase__summary">
            <div class="purchase__summary-row">
                <span>商品代金</span>
                <spam>¥{{ number_format($item->price) }}</spam>
            </div>
            <div class="purchase__summary-row">
                <span>支払い方法</span>
                <span id="payment_text">選択してください</span>
            </div>

            <button type="submit" class="purchase__button">
                購入する
            </button>
        </aside>
    </div>
</form>

<script>
    const select = document.getElementById('payment_method');
    const text = document.getElementById('payment_text');

    select.addEventListener('change', function () {
        text.textContent = select.value;
    });
</script>

@endsection