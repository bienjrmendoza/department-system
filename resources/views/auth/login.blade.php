@extends('layouts.app')

@section('content')

    <div class="container d-flex justify-content-center align-items-center min-vh-100 py-3">
        <div class="row w-100">
            <div class="col-md-6 col-12 mx-auto">
                <div class="card p-4 shadow-sm">
                    <div class="card-title text-center">
                        <h1>LOGIN</h1>
                    </div>
                    <hr>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <p>We encountered some issues with your submission. Please review the errors and try again. Thank you!></p>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control shadow-none @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control shadow-none @error('password') is-invalid @enderror" id="password" name="password" required>
                                        @error('password')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 fw-semibold mt-3">LOGIN</button>
                                    <p class="text-muted text-sm text-center mt-3">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Register here</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
