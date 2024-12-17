<div class="products-section">
    <div class="container">
        <h2 class="text-center my-5">Популярные товары</h2>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->short_description }}</p>
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary">Купить</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
