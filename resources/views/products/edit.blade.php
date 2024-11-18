@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>

    <form method="POST" action="{{ route('admin.products.update', $item->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ old('description', $item->description) }}</textarea>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="{{ old('price', $item->price) }}" step="0.01" required>
        </div>
        <div>
            <label for="slug">Slug:</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug', $item->slug) }}">
        </div>
        <div>
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="article">Article:</label>
            <input type="text" id="article" name="article" value="{{ old('article', $item->article) }}">
        </div>
        <button type="submit">Update</button>
    </form>
@endsection