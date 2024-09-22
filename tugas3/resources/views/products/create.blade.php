@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Produk</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Kuantiti</label>
            <input type="number" name="quantity" class="form-control" id="quantity" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" id="price" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Produk</button>
    </form>
</div>
@endsection
