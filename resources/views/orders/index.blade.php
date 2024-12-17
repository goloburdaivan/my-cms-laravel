@extends('layouts.app')

@section('content')
    <h1>Заказы</h1>

    <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="name" class="form-label">Имя:</label>
                <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Поиск по имени" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" value="{{ request('email') }}" placeholder="Поиск по email" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <label for="phone" class="form-label">Телефон:</label>
                <input type="text" id="phone" name="phone" value="{{ request('phone') }}" placeholder="Поиск по телефону" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="address" class="form-label">Адрес:</label>
                <input type="text" id="address" name="address" value="{{ request('address') }}" placeholder="Поиск по адресу" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="status" class="form-label">Статус:</label>
                <select id="status" name="status" class="form-select">
                    <option value="">Все статусы</option>
                    @foreach ($statuses as $key => $status)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Фильтровать</button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Сбросить</a>
        </div>
    </form>

    <a href="{{ route('admin.orders.create') }}" class="btn btn-success mb-3">Создать новый заказ</a>

    @if ($items->count())
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>ID пользователя</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Адрес</th>
                <th>Статус</th>
                <th>Общая цена</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">Просмотр</a>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $items->links() }}
        </div>
    @else
        <p>Заказы не найдены.</p>
    @endif
@endsection
