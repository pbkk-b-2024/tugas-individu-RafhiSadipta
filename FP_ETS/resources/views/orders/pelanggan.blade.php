@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pesanan Saya</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Detail</a>

                        <!-- Show "Selesai" button only if the status is 'sedang dikirim' -->
                        @if ($order->status == 'sedang dikirim')
                            <form action="{{ route('orders.complete', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                            </form>
                        @endif
                        
                        <!-- Show Review Button if Order is Completed -->
                        @if ($order->status == 'selesai')
                            @php
                                // Check if the user has already reviewed the order's products
                                $hasReviewed = $order->orderItems->contains(function($item) {
                                    return $item->reviews()->where('user_id', Auth::id())->exists();
                                });
                            @endphp

                            @if (!$hasReviewed)
                                <a href="{{ route('reviews.create', $order->id) }}" class="btn btn-primary btn-sm">Tulis Review</a>
                            @else
                                <p class="text-success">Anda sudah menulis review.</p>
                            @endif
                        @endif

                        @if ($order->status == 'selesai')
                            <a href="{{ route('reviews.index', $order->id) }}" class="btn btn-primary btn-sm">Lihat Review</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
