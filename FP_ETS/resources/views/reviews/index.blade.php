@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Review untuk Order ID: {{ $order->id }}</h1>
    <h3>Total: Rp{{ number_format($order->total_amount, 0, ',', '.') }}</h3>
    <h4>Status: {{ $order->status }}</h4>

    @foreach ($order->orderItems as $item)
        <h5>{{ $item->product->name }}</h5> <!-- Nama Produk -->
        
        @foreach ($reviews as $review)
            @if ($review->product_id == $item->product_id) <!-- Memastikan review sesuai dengan produk -->
                <p>Review: {{ $review->review }}</p>
                <p>Bintang: {{ $review->rating }}</p>
            @endif
        @endforeach
    @endforeach

    <!-- Conditional Back Button to Orders -->
    @if (Auth::user()->hasRole('admin'))
        <a href="{{ route('orders.admin') }}" class="btn btn-secondary">Kembali ke Daftar Order Admin</a>
    @else
        <a href="{{ route('orders.myOrders') }}" class="btn btn-secondary">Kembali ke Pesanan Saya</a>
    @endif
</div>
@endsection
