@extends('layouts.master')

@section('content')
    <h1>Creează bugetul lunar</h1>
    <form action="{{ route('pages.monthly.store') }}" method="POST">
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
            <label for="Amount">Limita lunară</label>
            <input type="text" class="form-control" id="Amount" name="Amount">
        </div>
        <button type="submit" class="btn btn-primary">Adaugă limita</button>
    </form>
@endsection
