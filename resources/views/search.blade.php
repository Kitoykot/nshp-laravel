@extends('layouts.main')

@section('content')
    <h3>Поиск</h3>

    <form method="GET" action="{{route('search')}}">
        <div class="searchClass form-group mt-5">
            <label for="">Что будем искать?</label>
            <input name="q" type="search" class="searchInput form-control" placeholder="жк телевизор...">
            <button type="submit" class="btn btn-success">Поиск</button>
        </div>
    </form>

    <div class="content mt-5">
        @foreach ($sales as $sale)
            <div class="sale">
                <img src="{{ $sale->image }}" width="200">
                <h6 class="title mt-2">{{ $sale->title }}</h6>
                <p class="description">{{ $sale->description }}</p>
                <p class="category">Категория: {{ App\Models\Category::find($sale->category_id)->title }}</p>
                <p class="price">Цена: {{ $sale->price }}</p>
                <a class="mt-5" href="one-sale/{{ $sale->id }}">Открыть</a>
            </div>
        @endforeach
    </div>
@endsection
