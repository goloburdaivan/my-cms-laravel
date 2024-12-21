<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Интернет-магазин')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Основной контейнер страницы */
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        .container {
            flex: 1; /* Растягиваем контейнер, чтобы он занимал все доступное пространство */
        }

        .category-item {
            margin-bottom: 10px;
        }

        .product-card {
            margin-bottom: 20px;
        }

        /* Футер */
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: auto; /* Выталкиваем футер вниз */
        }
    </style>
</head>
<body>
<!-- Хедер -->
<header class="bg-dark text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="/" class="text-white h3">Магазин</a>
        </div>
        <div>
            <a href="/profile" class="text-white me-3">Личный кабинет</a>
            <a href="/cart" class="text-white">
                <i class="fas fa-shopping-cart"></i> Корзина
            </a>
        </div>
    </div>
</header>

<!-- Основной контент -->
<div class="container mt-4">
    @yield('content')
</div>

<!-- Футер -->
<footer>
    <p>&copy; 2024 Интернет-магазин. Все права защищены.</p>
</footer>

<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToCartModalLabel">Успешно!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Товар успешно добавлен в корзину!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <a href="/cart" class="btn btn-primary">Перейти в корзину</a>
            </div>
        </div>
    </div>
</div>

<!-- Подключаем Bootstrap JS и Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stack('scripts')
</body>
</html>
