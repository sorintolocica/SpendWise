@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-secondary">Adaugare finante cheltuite</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pages.expense.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="category_id">Categoria</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Amount">Suma</label>
                                <input type="text" name="Amount" id="Amount" class="form-control @error('Amount') is-invalid @endError">
                                @error('Amount')
                                    <span class="text-danger fw-bold">{{$message}}</span>
                                @endError
                            </div>

                            <div class="form-group">
                                <label for="Date">Data</label>
                                <input type="date" name="Date" id="Date" class="form-control @error('Date') is-invalid @endError">
                                @error('Date')
                                <span class="text-danger fw-bold">{{$message}}</span>
                                @endError
                            </div>

                            <div class="form-group">
                                <label for="Description">Descrierea</label>
                                <textarea name="Description" id="Description" class="form-control @error('Description') is-invalid @endError" rows="4"></textarea>
                                @error('Description')
                                <span class="text-danger fw-bold">{{$message}}</span>
                                @endError
                            </div>

                            <button type="submit" class="btn btn-primary">Adauga in lista</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection
