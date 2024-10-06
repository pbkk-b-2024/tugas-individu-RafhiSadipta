@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Kuantiti</label>
            <input type="number" name="quantity" class="form-control" id="quantity" value="{{ $product->quantity }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ $product->price }}" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk</label>
            <input type="file" name="image" class="form-control" id="image">

            @if($product->image)
                <div class="mt-2">
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" width="150">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Produk</button>
    </form>
</div>
@endsection
