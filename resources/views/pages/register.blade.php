@extends('layouts.master')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h2 class="text-center mb-4">Înregistrare</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nume complet:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Introduceți numele complet" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Adresă de email:</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Introduceți adresa de email" value="{{ old('email') }}" required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Parolă:</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Introduceți parola" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirmați parola:</label>
                    <input type="password" class="form-control" id="confirm-password" name="password_confirmation" placeholder="Introduceți din nou parola" required>
                </div>
                <button type="submit" class="btn btn-primary">Înregistrează-te</button>
            </form>
        </div>
    </div>
@endsection
