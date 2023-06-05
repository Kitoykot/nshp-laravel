@extends('layouts.main')

@section('content')
    <ul class="list-group">
        @foreach ($sales as $sale)
            <form action="/public/{{ $sale->id }}" method="POST">
                @csrf
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $sale->title }}
                    <button type="submit"
                        class="{{ (int) $sale->public === 1 ? 'btn badge-danger' : 'btn badge-primary' }}">{{ (int) $sale->public === 1 ? 'Снять с публикации' : 'Опубликовать' }}</button>
                </li>
            </form>
            <div class="sales-upd-dlt mt-2 mb-3">
                <a class="btn btn-success" href="/update-sale/{{ $sale->id }}">Обновить</a>
                <form action="remove/{{ $sale->id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        @endforeach
    </ul>
@endsection
