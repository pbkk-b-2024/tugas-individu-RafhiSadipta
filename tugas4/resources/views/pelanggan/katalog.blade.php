@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Katalog Produk</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Kuantiti</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" min="1" max="{{ $product->quantity }}" value="1">
                            <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
