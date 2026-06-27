@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<main class="sell">
    <h1 class="sell__title">商品の出品</h1>

    <form class="sell-form" action="{{ route('sell.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="sell-form__group">
            <label class="sell-form__label">商品画像</label>
            <div class="sell-form__image-box">
                <img id="image-preview" class="sell-form__image-preview" alt="商品画像プレビュー">
                <label id="image-button" class="sell-form__image-button" for="image">
                    画像を選択する
                </label>

                <input class="sell-form__image-input" type="file" name="image" id="image" accept="image/*">
            </div>
            <button type="button" id="change-image-button" class="sell-form__change-button">
                画像を変更する
            </button>

            @error('image')
            <p class="form__error">
                {{ $message }}
            </p>
            @enderror
        </div>

        <h2 class="sell-form__section-title">商品の詳細</h2>

        <div class="sell-form__group">
            <label class="sell-form__label">カテゴリー</label>
            <div class="sell-form__category-list">
                @foreach ($categories as $category)
                <label class="sell-form__category">
                    <input class="sell-form__category-input" type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                    <span class="sell-form__category-text">
                        {{ $category->name }}
                    </span>
                </label>
                @endforeach
            </div>

            @error('categories')
            <p class="form__error">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="sell-form__group">
            <label class="sell-form__label" for="condition">商品の状態</label>
            <select class="sell-form__select" name="condition" id="condition">
                <option value="" disabled selected hidden>選択してください</option>
                <option value="良好" {{ old('condition') == '良好' ? 'selected' : '' }}>良好</option>
                <option value="目立った傷や汚れなし" {{ old('condition') == '目立った傷や汚れなし' ? 'selected' : '' }}>目立った傷や汚れなし</option>
                <option value="やや傷や汚れあり" {{ old('condition') == 'やや傷や汚れあり' ? 'selected' : '' }}>やや傷や汚れあり</option>
                <option value="状態が悪い" {{ old('condition') == '状態が悪い' ? 'selected' : '' }}>状態が悪い</option>
            </select>

            @error('condition')
            <p class="form__error">
                {{ $message }}
            </p>
            @enderror
        </div>

        <h2 class="sell-form__section-title">商品名と説明</h2>

        <div class="sell-form__group">
            <label class="sell-form__label">商品名</label>
            <input class="sell-form__input" type="text" name="name" value="{{ old('name') }}">

            @error('name')
            <p class="form__error">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="sell-form__group">
            <label class="sell-form__label">ブランド名</label>
            <input class="sell-form__input" type="text" name="brand" value="{{ old('brand') }}">
        </div>

        <div class="sell-form__group">
            <label class="sell-form__label">商品の説明</label>
            <textarea class="sell-form__textarea" name="description">{{ old('description') }}</textarea>

            @error('description')
            <p class="form__error">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="sell-form__group">
            <label class="sell-form__label">販売価格</label>
            <div class="sell-form__price-box">
                <span class="sell-form__yen">¥</span>
                <input class="sell-form__input" type="text" name="price" value="{{ old('price') }}">
            </div>

            @error('price')
            <p class="form__error">
                {{ $message }}
            </p>
            @enderror
        </div>

        <button class="sell-form__submit" type="submit">出品する</button>
    </form>
</main>

<script>
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const imageButton = document.getElementById('image-button');
    const changeImageButton = document.getElementById('change-image-button');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';

            imageButton.style.display = 'none';
            changeImageButton.style.display = 'block';
        }
    });

    changeImageButton.addEventListener('click', function() {
        imageInput.click();
    });
</script>
@endsection