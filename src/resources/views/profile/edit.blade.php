@extends('layouts.app')

@section('title', 'プロフィール設定')

@section('content')
<div class="profile">
    <h2 class="profile__heading">プロフィール設定</h2>

    <form class="profile-form" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="profile-form__image-area">
            <div class="profile-form__image">
                @if ($user->profile_image)
                <img id="image-preview" class="profile-form__preview" src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像">
                @else
                <img id="image-preview" class="profile-form__preview" style="display:none;" alt="プロフィール画像">
                @endif
            </div>

            <label class="profile-form__image-button">
                画像を選択する
                <input id="profile-image" type="file" name="profile_image" hidden>
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

<script>
    const imageInput = document.getElementById('profile-image');
    const imagePreview = document.getElementById('image-preview');

    imageInput.addEventListener('change', function() {

        const file = this.files[0];

        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';
        }
    });
</script>

@endsection