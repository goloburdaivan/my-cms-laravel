@extends('layouts.app')

@section('content')
    <h1>Редактировать продукт</h1>

    <form method="POST" action="{{ route('admin.products.update', $item->id) }}">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Возникли ошибки при заполнении формы:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Название:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" required class="form-control @error('name') is-invalid @enderror">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание:</label>
            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $item->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Цена:</label>
            <input type="number" id="price" name="price" value="{{ old('price', $item->price) }}" step="0.01" required class="form-control @error('price') is-invalid @enderror">
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Слаг:</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug', $item->slug) }}" class="form-control @error('slug') is-invalid @enderror">
            @error('slug')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Категория:</label>
            <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">Выберите категорию</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="article" class="form-label">Артикул:</label>
            <input type="text" id="article" name="article" value="{{ old('article', $item->article) }}" class="form-control @error('article') is-invalid @enderror">
            @error('article')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
@endsection
