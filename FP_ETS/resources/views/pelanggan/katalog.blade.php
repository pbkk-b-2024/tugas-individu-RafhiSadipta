@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Katalog Produk</h1>

    <!-- Form untuk pencarian produk -->
    <form action="{{ route('products.katalog') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Form untuk filter produk berdasarkan kategori -->
    <form action="{{ route('products.katalog') }}" method="GET">
        <div class="form-group">
            <label for="category">Filter Berdasarkan Kategori</label>
            <select name="category_id" id="category" class="form-control">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Filter</button>
    </form>

    <!-- Tampilkan produk yang difilter -->
    <div class="row mt-4">
        @forelse ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- Penanganan gambar produk -->
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            Harga: <strong>Rp{{ number_format($product->price, 0, ',', '.') }}</strong>
                        </p>
                        <p class="card-text">
                            Kuantitas: <strong>{{ $product->quantity }}</strong>
                        </p>

                        <!-- Form untuk menambah produk ke keranjang -->
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
            <!-- Pesan jika tidak ada produk -->
            <div class="col-12">
                <p>Tidak ada produk yang ditemukan.</p>
            </div>
        @endforelse
    </div>
    <!-- Link pagination -->
    <div class="d-flex justify-content-center">
    {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>

<!-- CSS khusus untuk halaman ini -->
<style>
    /* Atur agar gambar memiliki tinggi tetap */
    .card-img-top {
        object-fit: cover;
        height: 300px; /* Sesuaikan tinggi gambar sesuai kebutuhan */
    }
</style>

@endsection
