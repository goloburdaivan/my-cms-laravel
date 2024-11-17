@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="container">
        <article class="card">
            <h2 class="title">Login</h2>

            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" class="form">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="form-input">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" required class="form-input">
                </div>

                <div class="form-group form-group--checkbox">
                    <input type="checkbox" id="remember" name="remember" class="form-checkbox">
                    <label for="remember" class="form-label--inline">Remember Me</label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Login</button>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link">Forgot Password?</a>
                    @endif
                </div>
            </form>
        </article>
    </section>
@endsection
