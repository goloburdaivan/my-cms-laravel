<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Панель администратора')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }

        #sidebarMenu {
            height: 100vh;
            overflow-y: auto;
        }

        main {
            padding: 0;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Админ-панель</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Переключить навигацию">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.products.index') }}">Продукты</a>
                </li>
            </ul>
            <form method="POST" action="{{ route('admin.logout') }}" class="d-flex">
                @csrf
                <button class="btn btn-outline-light" type="submit">Выйти</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row" style="height: calc(100% - 56px);">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i> Главная
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.products.index') }}">
                            <i class="fas fa-briefcase"></i> Продукты
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.categories.index') }}">
                            <i class="fas fa-list-alt"></i> Категории
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.attributes.index') }}">
                            <i class="fas fa-list-alt"></i> Аттрибуты
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders.index') }}">
                            <i class="fas fa-list-alt"></i> Заказы
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pages.index') }}">
                            <i class="fas fa-list-alt"></i> Страницы
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
