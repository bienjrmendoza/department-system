@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12">
                <div class="card d-flex justify-content-center align-items-center p-4">
                    <div class="card-title">
                        <h1>LOGIN</h1>
                    </div>
                    <hr class="w-100">
                    <div class="card-body w-100">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control shadow-none" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control shadow-none" id="password" name="password" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button type="submit" class="btn btn-primary w-100 fw-semibold">LOGIN</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
