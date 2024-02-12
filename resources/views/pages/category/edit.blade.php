@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-secondary">Editează categorie</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pages.category.update', $category) }}">
                            @csrf
                            @method('PUT') <!-- Specificăm metoda HTTP PUT pentru actualizare -->

                            <div class="form-group">
                                <label for="name">Nume categorie</label>
                                <input type="text" name="Name" id="name" class="form-control" value="{{ $category->Name }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Actualizează categorie</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
