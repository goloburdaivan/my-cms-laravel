@extends('layouts.app')

@section('content')
    <h1>Детали аттрибута</h1>

    <div class="mb-3">
        <strong>ID:</strong> {{ $item->id }}
    </div>

    <div class="mb-3">
        <strong>Название:</strong> {{ $item->name }}
    </div>

    <div class="mb-3">
        <strong>Значение:</strong> {{ $item->value }}
    </div>


    <a href="{{ route('admin.attributes.edit', $item->id) }}" class="btn btn-warning">Редактировать</a>
    <form action="{{ route('admin.attributes.destroy', $item->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
    </form>
    <a href="{{ route('admin.attributes.index') }}" class="btn btn-secondary">Назад к списку</a>
@endsection
