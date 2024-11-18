@extends('layouts.app')

@section('content')
    <h1>Аттрибуты</h1>

    <form method="GET" action="{{ route('admin.attributes.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label for="name" class="form-label">Название атрибута:</label>
                <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Поиск по названию"
                       class="form-control">
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Фильтровать</button>
            <a href="{{ route('admin.attributes.index') }}" class="btn btn-secondary">Сбросить</a>
        </div>
    </form>

    <a href="{{ route('admin.attributes.create') }}" class="btn btn-success mb-3">Создать новый аттрибут</a>

    @if ($items->count())
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Значение</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $attribute)
                <tr>
                    <td>{{ $attribute->id }}</td>
                    <td>{{ $attribute->name }}</td>
                    <td>{{ $attribute->value }}</td>
                    <td>
                        <a href="{{ route('admin.attributes.show', $attribute->id) }}" class="btn btn-info btn-sm">Просмотр</a>
                        <a href="{{ route('admin.attributes.edit', $attribute->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <form action="{{ route('admin.attributes.destroy', $attribute->id) }}" method="POST"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $items->links() }}
        </div>
    @else
        <p>Аттрибуты не найдены.</p>
    @endif
@endsection
