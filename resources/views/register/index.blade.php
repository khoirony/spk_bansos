@extends('layouts.main')

@section('container')

<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <main class="form-registration">
            <h1 class="h3 text-center mb-3 fw-normal">Form Registrasi</h1>
            <form action="/register" method="post">
                @csrf
                <div class="form-floating">
                    <input type="text" class="form-control rounded-top @error('name') is-invalid @enderror" name="name"
                        id="name" placeholder="Name" required value="{{ old('name') }}">
                    <label for="floatingInput">Name</label>
                    @error('name')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                    <label for="floatingInput">Email address</label>
                    @error('email')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" name="password" id="password"
                        placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                    @error('password')
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
            </form>
            <small class="d-block text-center mt-3">Already Registered? <a href="/">Login!</a></small>
        </main>
    </div>
</div>

@endsection
