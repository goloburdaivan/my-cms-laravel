@extends('site.layout')

@section('title', 'User Dashboard')

@section('content')
    <section class="container my-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Welcome, {{ Auth::user()->name }}</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="#orders" class="text-decoration-none">My Orders</a>
                            </li>
                            <li class="list-group-item"><a href="#wishlist" class="text-decoration-none">Wishlist</a>
                            </li>
                            <li class="list-group-item"><a href="#profile" class="text-decoration-none">Profile
                                    Settings</a></li>
                            <li class="list-group-item"><a href="#address" class="text-decoration-none">Address Book</a>
                            </li>
                            <li class="list-group-item"><a href="#" class="text-decoration-none text-danger">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div id="orders" class="mb-5">
                    <h4>My Orders</h4>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if ($orders->isEmpty())
                                <p>No orders yet.</p>
                            @else
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>${{ number_format($order->total_price, 2) }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#orderItems-{{ $order->id }}">
                                                    View Items
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <div id="orderItems-{{ $order->id }}" class="collapse">
                                                    <table class="table table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Item</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($order->items as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $item->product->name }}</td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>${{ number_format($item->price, 2) }}</td>
                                                                <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div id="wishlist" style="padding-top: 50px" class="mb-5">
                <h4>Wishlist</h4>
                <div class="card shadow-sm">
                    <div class="card-body">
                        @if($wishlist->isEmpty())
                            <p>Your wishlist is empty.</p>
                        @else
                            <div class="row">
                                @foreach($wishlist as $item)
                                    <div class="col-md-4 mb-4">
                                        <div class="card product-card">
                                                <img src="{{ $item->product->images->first()?->url ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $item->product->name }}">
                                                <div class="card-body">
                                                    <a href="{{ route('products.show', ['slug' => $item->product->slug]) }}" class="text-decoration-none">
                                                        <h5 class="card-title">{{ $item->product->name }}</h5>
                                                    </a>
                                                    <p class="card-text">{{ $item->product->price }}$</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button class="btn btn-outline-danger remove-from-wishlist" data-wishlist-id="{{ $item->id }}">Удалить</button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="profile" class="mb-5">
                <h4>Profile Settings</h4>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}"
                                       class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}"
                                       class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('.remove-from-wishlist').on('click', function(e) {
            e.preventDefault();
            let wishlistId = $(this).data('wishlist-id');

            $.ajax({
                url: '/wishlist/remove/' + wishlistId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    alert('Товар удален из вишлиста!');
                    location.reload();
                },
                error: function() {
                    alert('Произошла ошибка. Попробуйте позже.');
                }
            });
        });
    </script>
@endpush
