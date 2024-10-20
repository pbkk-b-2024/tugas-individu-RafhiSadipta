@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Keranjang Belanja</h1>

    <div class="row">
        @if ($cartItems->count() > 0)
            @foreach ($cartItems as $item)
                <div class="col-12 mb-4">
                    <div class="card d-flex flex-row align-items-center">
                        <!-- Gambar produk -->
                        <img src="{{ Storage::url($item->product->image) }}" class="card-img-left" alt="{{ $item->product->name }}" style="width: 150px; height: 150px; object-fit: cover;">

                        <!-- Informasi produk -->
                        <div class="card-body d-flex flex-column justify-content-between" style="flex-grow: 1;">
                            <h5 class="card-title">{{ $item->product->name }}</h5>
                            <p class="card-text">Harga: Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                            <p class="card-text">Kuantitas: {{ $item->quantity }}</p>
                            <p class="card-text">Subtotal: Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>

                        <!-- Tombol hapus -->
                        <div class="p-3">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Menghitung total -->
            @php
                $totalAmount = $cartItems->sum(function($item) {
                    return $item->product->price * $item->quantity;
                });

                // Cek apakah ada diskon yang diterapkan
                $discountAmount = session('discount_amount', 0);
                $totalAfterDiscount = $totalAmount - $discountAmount;
            @endphp

            <div class="col-12">
                <h3>Total: Rp{{ number_format($totalAfterDiscount, 0, ',', '.') }}</h3>

                <!-- Menampilkan pesan diskon -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Form untuk menerapkan kode diskon -->
                <form action="{{ route('cart.applyDiscount') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="form-group">
                        <label for="discount_code">Kode Diskon</label>
                        <input type="text" name="discount_code" class="form-control" placeholder="Masukkan kode diskon (opsional)">
                    </div>
                    <!-- Tombol Terapkan Diskon -->
                    <button type="submit" class="btn btn-secondary">Terapkan Diskon</button>
                </form>

                <!-- Form untuk pembayaran -->
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="payment_method">Metode Pembayaran</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="credit_card">Kartu Kredit</option>
                            <option value="bank_transfer">Transfer Bank</option>
                        </select>
                    </div>

                    <!-- Tombol Checkout -->
                    <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                </form>

            </div>
        @else
            <div class="col-12">
                <p>Keranjang Anda kosong.</p>
            </div>
        @endif
    </div>
</div>
@endsection
