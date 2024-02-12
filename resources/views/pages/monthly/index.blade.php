@extends('layouts.master')

@section('content')
    <h1>Limitele bugetelor pe categorie</h1>
    <a href="{{ route('pages.monthly.create') }}" class="btn btn-primary mb-2">Adauga o limita</a>

    <div class="row">
        {{-- Afișează suma totală a cheltuielilor --}}
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Suma totala lunară:</h5>
                    <p class="card-text">{{ $user->expenses_sum_amount }} <b>RON</b></p>
                    <h5 class="card-title">Suma limită:</h5>
                    {{-- Afișează suma totală a limitelor lunare --}}
                    <p class="card-text">Suma limită: {{ $user->monthly_budget_sum_amount }} <b>RON</b></p>
                </div>
            </div>
        </div>

        {{-- Afiseaza suma totala și limita lunară pentru fiecare categorie --}}
        @foreach ($monthlyExpenses as $data)

            <div class="col-md-4 mb-3">
                <div class="card{{ $data->budget && $data->total_spent > $data->budget ? ' border-danger' : '' }}">
                    <div class="card-body">
                        <h5 class="card-title">Categoria: {{ $data->category }}</h5>
                        {{-- Afișează suma totală pentru categoria curentă --}}
                        <p class="card-text">A-ti cheltuit deja: {{ $data->total_spent }}</p>
                        {{-- Afișează limita lunară pentru categoria curentă --}}
                        <p class="card-text{{ $data->budget && $data->total_spent > $data->budget ? ' text-danger' : '' }}">Limita lunara: {{ $data->budget ?? 'Nu exista limita lunara' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
