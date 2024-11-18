@extends('layouts.app')

@section('content')
    <h1>Редактировать продукт</h1>

    <ul class="nav nav-tabs" id="productTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button"
                    role="tab" aria-controls="info" aria-selected="true">
                Информация о продукте
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="attributes-tab" data-bs-toggle="tab" data-bs-target="#attributes" type="button"
                    role="tab" aria-controls="attributes" aria-selected="false">
                Атрибуты продукта
            </button>
        </li>
    </ul>

    <div class="tab-content" id="productTabContent">
        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
            <form method="POST" action="{{ route('admin.products.update', $item->id) }}">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <strong>Возникли ошибки при заполнении формы:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Название:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" required
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Описание:</label>
                    <textarea id="description" name="description"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $item->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Цена:</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $item->price) }}" step="0.01"
                           required class="form-control @error('price') is-invalid @enderror">
                    @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Слаг:</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $item->slug) }}"
                           class="form-control @error('slug') is-invalid @enderror">
                    @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Категория:</label>
                    <select id="category_id" name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">Выберите категорию</option>
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
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
                    <input type="text" id="article" name="article" value="{{ old('article', $item->article) }}"
                           class="form-control @error('article') is-invalid @enderror">
                    @error('article')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Обновить</button>
            </form>
        </div>

        <div class="tab-pane fade" id="attributes" role="tabpanel" aria-labelledby="attributes-tab">
            <form method="POST" action="{{ route('admin.products.updateAttributes', $item->id) }}">
                @csrf

                <div class="mb-3 mt-3">
                    <label for="attributes" class="form-label">Выберите атрибуты:</label>
                    <select id="attributes" name="attributes[]" multiple
                            class="form-select @error('attributes') is-invalid @enderror">
                        @foreach ($attributes as $attribute)
                            <option
                                value="{{ $attribute->id }}" {{ in_array($attribute->id, old('attributes', $item->attributes->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $attribute->name }} - {{ $attribute->value }}
                            </option>
                        @endforeach
                    </select>
                    @error('attributes')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Сохранить атрибуты</button>
            </form>

            <div class="mt-5">
                <h3>Текущие атрибуты продукта</h3>

                @if($item->attributes->isEmpty())
                    <p>Атрибуты не добавлены.</p>
                @else
                    <table class="table table-bordered mt-3">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Значение</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item->attributes as $attribute)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>{{ $attribute->value }}</td>
                                <td>
                                    <form
                                        action="{{ route('admin.products.updateAttributes', [$item->id, $attribute->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Вы уверены, что хотите удалить этот атрибут?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
