@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Order #{{ $order->id }}</h1>
    <h3>Pelanggan: {{ $order->user->name }}</h3>
    <h4>Status: {{ $order->status }}</h4>

    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Kuantitas</th>
                <th>Review</th>
                <th>Bintang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        @if ($item->product->reviews->first())
                            {{ $item->product->reviews->first()->review }}
                        @else
                            <em>Belum ada review.</em>
                        @endif
                    </td>
                    <td>
                        @if ($item->product->reviews->first())
                            {{ $item->product->reviews->first()->rating }} / 5
                        @else
                            <em>-</em>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar Order</a>
</div>
@endsection
