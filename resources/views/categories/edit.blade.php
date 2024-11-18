@extends('layouts.app')

@section('content')
    <h1>Редактировать категорию</h1>

    <form method="POST" action="{{ route('admin.categories.update', $item->id) }}" enctype="multipart/form-data">
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
            <label for="parent_id" class="form-label">Родительская категория:</label>
            <select id="parent_id" name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                <option value="">Нет</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('parent_id', $item->parent_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('parent_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" id="published" name="published" value="1" {{ old('published', $item->published) ? 'checked' : '' }} class="form-check-input @error('published') is-invalid @enderror">
            <label for="published" class="form-check-label">Опубликовано</label>
            @error('published')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="sort" class="form-label">Порядок сортировки:</label>
            <input type="number" id="sort" name="sort" value="{{ old('sort', $item->sort) }}" class="form-control @error('sort') is-invalid @enderror">
            @error('sort')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if ($item->image)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="max-width: 200px;">
            </div>
        @endif

        <div class="mb-3">
            <label for="image" class="form-label">Изображение:</label>
            <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Оставьте пустым, если не хотите менять изображение.</small>
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
@endsection