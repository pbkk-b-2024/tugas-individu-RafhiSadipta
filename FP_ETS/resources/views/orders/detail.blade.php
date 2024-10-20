@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pesanan ID: {{ $order->id }}</h1>

    <h3>Total: Rp{{ number_format($order->total_amount, 0, ',', '.') }}</h3>
    <h4>Status: {{ $order->status }}</h4>

    <h5>Item dalam Pesanan:</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Kuantitas</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if(auth()->user()->hasRole('admin'))
        <a href="{{ route('orders.admin') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
    @elseif(auth()->user()->hasRole('pelanggan'))
        <a href="{{ route('orders.myOrders') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
    @endif
</div>
@endsection
