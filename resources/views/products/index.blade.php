@extends('layouts.app')

@section('content')
    <h1>Продукты</h1>

    <form method="GET" action="{{ route('admin.products.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="name" class="form-label">Название продукта:</label>
                <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Поиск по названию" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="article" class="form-label">Артикул:</label>
                <input type="text" id="article" name="article" value="{{ request('article') }}" placeholder="Поиск по артикулу" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="category_name" class="form-label">Категория:</label>
                <select id="category_name" name="category_id" class="form-select">
                    <option value="">Все категории</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Фильтровать</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Сбросить</a>
        </div>
    </form>

    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">Создать новый продукт</a>

    @if ($items->count())
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Категория</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ Str::limit($product->description, 50) }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name ?? 'Без категории' }}</td>
                    <td>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">Просмотр</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">Удалить</button>
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
        <p>Продукты не найдены.</p>
    @endif
@endsection
