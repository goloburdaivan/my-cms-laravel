@extends('site.layout')

@section('title', 'Товары')

@section('content')
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Слайд 1">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Слайд 2">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Слайд 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Предыдущий</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Следующий</span>
        </button>
    </div>

    <div class="row mt-4">
        <div class="col-md-3">
            <h4>Категории</h4>
            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item category-item">
                        <a href="/categories/{{ $category->id }}" class="text-decoration-none">{{ $category->name }}</a>
                        @if($category->children->isNotEmpty())
                        <ul class="list-group ms-3 mt-2">
                            @foreach($category->children as $subcategory)
                                <li class="list-group-item">
                                    <a href="/categories/{{ $subcategory->id }}" class="text-decoration-none">{{ $subcategory->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Список товаров -->
        <div class="col-md-9">
            <h4>Товары</h4>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card product-card">
                            <a href="{{ route('products.show', ['slug' => $product->slug]) }}" class="text-decoration-none">
                                <img src="{{ $product->images->first()?->url }}" class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->price }}$</p>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-primary add-to-cart" data-product-id="{{ $product->id }}">Добавить в корзину</button>
                                        @auth
                                            <button class="btn btn-outline-secondary add-to-wishlist" data-product-id="{{ $product->id }}">В желаемое</button>
                                        @endauth
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
