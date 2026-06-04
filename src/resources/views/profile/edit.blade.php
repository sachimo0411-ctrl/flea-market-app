@extends('layouts.app')

@section('title', 'プロフィール設定')

@section('content')
<div class="profile">
    <h2 class="profile__heading">プロフィール設定</h2>

    <form class="profile-form" method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="profile-form__image-area">
            <div class="profile-form__image"></div>

            <label class="profile-form__image-button">
                画像を選択する
                <input type="file" name="profile_image" hidden>
            </label>
        </div>

        <div class="profile-form__group">
            <label class="profile-form__label" for="name">ユーザー名</label>
            <input class="profile-form__input" type="text" name="name" id="name" value="{{ old('name', $user->name) }}">

            @error('name')
            <p class="form__error">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="profile-form__group">
            <label class="profile-form__label" for="postal_code">郵便番号</label>
            <input class="profile-form__input" type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $user->postal_code) }}">

            @error('postal_code')
            <p class="form__error">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="profile-form__group">
            <label class="profile-form__label" for="address">住所</label>
            <input class="profile-form__input" type="text" name="address" id="address" value="{{ old('address', $user->address) }}">

            @error('address')
            <p class="form__error">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="profile-form__group">
            <label class="profile-form__label" for="building_name">建物名</label>
            <input class="profile-form__input" type="text" name="building_name" id="building_name" value="{{ old('building_name', $user->building_name) }}">
        </div>

        <div class="profile-form__button">
            <button class="profile-form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection