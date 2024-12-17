@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Создать заказ</h1>

    <form method="POST" action="{{ route('admin.orders.store') }}" class="row g-3">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Возникли ошибки при заполнении формы:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-md-6">
            <label for="name" class="form-label">Имя:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control @error('name') is-invalid @enderror">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="phone" class="form-label">Телефон:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required class="form-control @error('phone') is-invalid @enderror">
            @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-control @error('email') is-invalid @enderror">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-12">
            <label for="address" class="form-label">Адрес:</label>
            <textarea id="address" name="address" rows="3" required class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
            @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="status" class="form-label">Статус:</label>
            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                <option value="">Выберите статус</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="total_price" class="form-label">Общая цена:</label>
            <input type="number" id="total_price" name="total_price" value="{{ old('total_price') }}" step="0.01" required class="form-control @error('total_price') is-invalid @enderror">
            @error('total_price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Создать заказ</button>
        </div>
    </form>
@endsection
