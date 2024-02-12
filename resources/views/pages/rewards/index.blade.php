@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Acordați puncte pentru economii</h1>
        <form action="{{ route('pages.rewards.index') }}" method="POST">
            @csrf
            <button type="submit">Primește puncte pentru economii</button>
        </form>
        <!-- Afișează mesajul de răspuns -->
        @if(session('message'))
            <p>{{ session('message') }}</p>
        @endif
        </div>
    </div>
@endsection
