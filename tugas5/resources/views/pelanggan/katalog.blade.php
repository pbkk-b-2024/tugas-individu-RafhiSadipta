@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Katalog Produk</h1>

    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Harga: Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="card-text">Kuantiti: {{ $product->quantity }}</p>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="number" name="quantity" class="form-control" min="1" max="{{ $product->quantity }}" value="1" required>
                                <button class="btn btn-primary" type="submit">Tambah ke Keranjang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>Tidak ada produk.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
