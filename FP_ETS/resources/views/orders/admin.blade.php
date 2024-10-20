@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Order</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
                <th>Review</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order) <!-- Pastikan orders didefinisikan -->
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()">
                                <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="sedang dikirim" {{ $order->status == 'sedang dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('orders.adminshow', $order->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                    <td>
                        @if($order->status == 'selesai')
                            <a href="{{ route('reviews.index', $order->id) }}" class="btn btn-warning btn-sm">Lihat Review</a>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
