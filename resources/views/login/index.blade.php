@extends('layouts.main')

@section('container')

<div class="row justify-content-center pt-5">
    <div class="col-md-5">
        @if(session()->has('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session()->has('loginError'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <main class="form-signin">
            <h3 class="text-center mb-0">SISTEM PENDUKUNG KEPUTUSAN</h3>
            <h3 class="fw-normal text-center mb-4">Penentu Kelayakan Penerima Bantuan Sosial</h3>
            <form action="/" method="POST">
                @csrf
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                    <label for="email">Email address</label>
                    @error('email')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        required>
                    <label for="password">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
            <small class="d-block text-center mt-3">Not Registered? <a href="/register">Register Now!</a></small>
        </main>
    </div>
</div>

@endsection
