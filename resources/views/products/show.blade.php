@extends('layouts.app')

@section('content')
    <h1>Product Details</h1>

    <div>
        <strong>Name:</strong> {{ $item->name }}
    </div>
    <div>
        <strong>Description:</strong> {{ $item->description }}
    </div>
    <div>
        <strong>Price:</strong> {{ $item->price }}
    </div>
    <div>
        <strong>Slug:</strong> {{ $item->slug }}
    </div>
    <div>
        <strong>Category:</strong> {{ $item->category->name ?? 'No category' }}
    </div>
    <div>
        <strong>Article:</strong> {{ $item->article }}
    </div>

    <a href="{{ route('admin.products.edit', $item->id) }}">Edit</a>
    <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <a href="{{ route('admin.products.index') }}">Back to List</a>
@endsection
