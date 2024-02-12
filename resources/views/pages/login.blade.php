@extends('layouts.master')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <h2 class="text-center mb-4">Autentificare</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Adresa de email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" value="{{ old('email') }}" required autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Parola</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Ține-mă minte</label>
            </div>
            <button type="submit" class="btn btn-primary">Autentificare</button>
        </form>
        <hr>
        <div class="text-center">
            <a href="{{ route('register') }}">Nu ai niciun cont?</a>
        </div>
    </div>
</div>
@endsection
