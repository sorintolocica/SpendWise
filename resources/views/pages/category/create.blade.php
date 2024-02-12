@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-secondary">Creaza categoria pentru cheltuieli</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pages.category.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nume categorie</label>
                                <input type="text" name="Name" id="name" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Adaugă categorie</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-8">
            <div class="card bg-secondary">
                <div class="card-header">Categorii existente</div>

                <div class="card-body text-center">
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        {{ $category->Name }}
                                        <div class="mt-2">
                                            <!-- Formular pentru ștergere soft -->
                                            <form method="POST" action="{{ route('pages.category.destroy', $category->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Esti sigur ca vrei sa stergi aceasta categorie (stergerea va fi soft)?')">Ștergere</button>
                                            </form>
                                            <br>
                                            <!-- End Formular pentru ștergere soft -->
                                            <a href="{{ route('pages.category.edit', $category->id) }}" class="btn btn-sm btn-primary">Editare</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
