@extends('layouts.app')

@section('content')
    <h1>Детали продукта</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $item->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Категория: {{ $item->category->name ?? 'Без категории' }}</h6>
            <p class="card-text"><strong>Описание:</strong> {{ $item->description }}</p>
            <p class="card-text"><strong>Цена:</strong> {{ $item->price }}</p>
            <p class="card-text"><strong>Артикул:</strong> {{ $item->article }}</p>
            <p class="card-text"><strong>Слаг:</strong> {{ $item->slug }}</p>
        </div>
    </div>

    <div class="mb-3">
        <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-warning">Редактировать</a>

        <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот продукт?')">Удалить</button>
        </form>

        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Назад к списку</a>
    </div>
@endsection
