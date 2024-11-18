@extends('layouts.app')

@section('content')
    <h1>Детали категории</h1>

    <div class="mb-3">
        <strong>ID:</strong> {{ $item->id }}
    </div>

    <div class="mb-3">
        <strong>Название:</strong> {{ $item->name }}
    </div>

    <div class="mb-3">
        <strong>Родительская категория:</strong> {{ $item->parent->name ?? 'Нет' }}
    </div>

    <div class="mb-3">
        <strong>Опубликовано:</strong> {{ $item->published ? 'Да' : 'Нет' }}
    </div>

    <div class="mb-3">
        <strong>Порядок сортировки:</strong> {{ $item->sort }}
    </div>

    @if ($item->image)
        <div class="mb-3">
            <strong>Изображение:</strong><br>
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="max-width: 200px;">
        </div>
    @endif

    <a href="{{ route('admin.categories.edit', $item->id) }}" class="btn btn-warning">Редактировать</a>
    <form action="{{ route('admin.categories.destroy', $item->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
    </form>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Назад к списку</a>
@endsection
