@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Produk</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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

                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>

                        <!-- Form hapus produk -->
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
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
