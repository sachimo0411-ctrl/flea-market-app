@extends('layouts.app')

@section('title', '住所の変更')

@section('content')
<div class="address">
    <div class="address__content">
        <h2 class="address__heading">住所の変更</h2>
    </div>

    <form class="address-form" method="post" action="{{ route('address.update', $item->id) }}">
        @csrf
        <div class="address-form__group">
            <label class="address-form__label" for="postal_code">郵便番号</label>
            <input class="address-form__input" type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $user->postal_code) }}">

            @error('postal_code')
                <p class="form__error">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="address-form__group">
            <label class="address-form__label" for="address">住所</label>
            <input class="address-form__input" type="text" name="address" id="address" value="{{ old('address', $user->address) }}">

            @error('address')
                <p class="form__error">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="address-form__group">
            <label class="address-form__label" form="building_name">建物名</label>
            <input class="address-form__input" type="text" name="building_name" id="building_name" value="{{ old('building_name', $user->building_name) }}">
        </div>

        <div class="address-form__button">
            <button class="address-form__submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection