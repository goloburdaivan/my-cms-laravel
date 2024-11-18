@extends('layouts.app')

@section('content')
    <h1>Products</h1>

    <form method="GET" action="{{ route('admin.products.index') }}" class="mb-4">
        <div>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Search by name">
        </div>
        <div>
            <label for="article">Article:</label>
            <input type="text" id="article" name="article" value="{{ request('article') }}" placeholder="Search by article">
        </div>
        <div>
            <label for="category_name">Category:</label>
            <select id="category_name" name="category_id">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Filter</button>
    </form>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create New Product</a>

    @if ($items->count())
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ Str::limit($product->description, 50) }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name ?? 'No category' }}</td>
                    <td>
                        <a href="{{ route('admin.products.show', $product->id) }}">View</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $items->links() }}
    @else
        <p>No products found.</p>
    @endif
@endsection
