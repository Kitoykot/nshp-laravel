@extends('layouts.main')

@section('content')
    <h3>{{ $sale->title }}</h3>
    <div class="saleOne mt-5">
        <img src="{{ $sale->image }}" width="500">
        <div class="infoOne mt-3 pl-3">
            <p class="descriptionOne">{{ $sale->description }}</p>
            <h6>Категория: {{App\Models\Category::find($sale->category_id)->title}}</h6>
            <h3 class="priceOne">Цена: {{ $sale->price }}</h3>
            <h4 class="contactsOne">Контакты:</h4>
            <h6>Телефон: {{App\Models\User::find($sale->user_id)->phone}} | E-mail: {{App\Models\User::find($sale->user_id)->email}}</h6>
        </div>
    </div>
@endsection
