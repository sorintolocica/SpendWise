@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">
                        Lista de finanțe
                        <a href="{{ route('pages.expense.create') }}" class="btn btn-sm btn-dark float-right">Adaugă în lista cheltuieli</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Categorie</th>
                                    <th>Suma</th>
                                    <th>Data</th>
                                    <th>Descriere</th>
                                    <th>Modificare</th>
                                    <th>Ștergere</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($expenses as $expense)
                                    <tr>
                                        <td>{{ $expense->id }}</td>
                                        <td>{{ $expense->category->Name }}</td> <!-- Afiseaza numele categoriei -->
                                        <td>{{ $expense->Amount }}</td>
                                        <td>{{ $expense->Date }}</td>
                                        <td>{{ $expense->Description}}</td>
                                        <td>
                                            <!-- Buton pentru editare -->
                                            <a href="{{ route('pages.expense.edit', $expense->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-solid fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <!-- Formular pentru ștergere -->
                                            <form action="{{ route('pages.expense.destroy', $expense->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ești sigur că vrei să ștergi această înregistrare?')"><i class="fas fa-solid fa-trash"></i> Șterge</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header bg-secondary">Recompense</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Puncte</th>
                                    <th>Descriere</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($rewards as $reward)
                                    <tr>
                                        <td>{{ $reward->id }}</td>
                                        <td>{{ $reward->points }}</td>
                                        <td>{{ $reward->description }}</td>
                                        <td>{{ $reward->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
