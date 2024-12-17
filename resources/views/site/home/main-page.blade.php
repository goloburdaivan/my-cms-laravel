@extends('site.layout')

@section('title', 'Товары')

@section('content')
    <!-- Слайдер (карусель) -->
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
                        <a href="/category/{{ $category->slug }}" class="text-decoration-none">{{ $category->name }}</a>
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
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->price }}$</p>
                                    <button class="btn btn-primary add-to-cart" data-product-id="{{ $product->id }}">Добавить в корзину</button>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // При клике на кнопку "Добавить в корзину"
            $('.add-to-cart').on('click', function(e) {
                e.preventDefault();

                var productId = $(this).data('product-id'); // Идентификатор товара
                var quantity = 1;

                $.ajax({
                    url: '/cart/add/' + productId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Защита от CSRF
                        quantity: quantity,
                    },
                    success: function(response) {
                        $('.cart-count').text(response.cart_count);
                        $('#addToCartModal').modal('show');
                    },
                    error: function() {
                        alert('Произошла ошибка. Попробуйте позже.');
                    }
                });
            });
        });
    </script>
@endpush
