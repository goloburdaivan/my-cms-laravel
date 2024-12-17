@extends('site.layout')

@section('title', $product->name)

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <img src="{{ $product->images->first()->url }}" alt="{{ $product->name }}" class="img-fluid" />
            </div>
            <h3>{{ $product->name }}</h3>
            <p class="text-muted">{{ $product->article }}</p>
            <p>{{ $product->description }}</p>
            <h4>{{ $product->price }}$</h4>
            <a href="#" class="btn btn-primary">Добавить в корзину</a>
        </div>

        <div class="col-md-8">
            <ul class="nav nav-tabs" id="productTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Основная информация</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="gallery-tab" data-bs-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false">Галерея</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="attributes-tab" data-bs-toggle="tab" href="#attributes" role="tab" aria-controls="attributes" aria-selected="false">Характеристики</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Отзывы</a>
                </li>
            </ul>

            <div class="tab-content mt-3" id="productTabContent">
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <h5>Описание товара</h5>
                    <p>{{ $product->description }}</p>
                    <h5>Цена</h5>
                    <p>{{ $product->price }}$</p>
                    <h5>Артикул</h5>
                    <p>{{ $product->article }}</p>
                </div>

                <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                    <div class="row">
                        @foreach($product->images as $image)
                            <div class="col-md-3 mb-3">
                                <img src="{{ $image->url }}" alt="{{ $product->name }} - Фото" class="img-fluid" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="tab-pane fade" id="attributes" role="tabpanel" aria-labelledby="attributes-tab">
                    <h5>Характеристики товара</h5>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Характеристика</th>
                            <th>Значение</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->attributes as $attribute)
                            <tr>
                                <td><strong>{{ $attribute->name }}</strong></td>
                                <td>{{ $attribute->value }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <h5>Отзывы покупателей</h5>
                    <p>Здесь будут отображаться отзывы о товаре.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
@endpush
