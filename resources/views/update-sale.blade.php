@extends('layouts.main')

@section('content')
    <h3>Обновить: {{ $sale->title }}</h3>

    <form class="mt-5" method="POST" action="/update/{{ $sale->id }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                value="{{ $sale->title }}" placeholder="Смартфон Samsung">

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <input type="description" class="form-control @error('description') is-invalid @enderror" name="description"
                value="{{ $sale->description }}" placeholder="Рабочий, но без зарядки">

            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Категория</label>
            <select name="category_id" class="form-control">
                <option value="{{ \App\Models\Category::find($sale->category_id)->id }}">
                    {{ \App\Models\Category::find($sale->category_id)->title }}</option>
                @foreach ($categories as $category)
                    @if ($category->title !== \App\Models\Category::find($sale->category_id)->title)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="price">Цена в рублях</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                value="{{ $sale->price }}" placeholder="5000">

            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Изображение</label>
            <br>
            <img src="{{ $sale->image }}" width="300">
            <br><br>
            <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">

            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Обновить объявление</button>
    </form>
@endsection
