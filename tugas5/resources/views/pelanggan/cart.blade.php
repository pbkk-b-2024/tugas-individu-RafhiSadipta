@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Keranjang Belanja</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($cartItems->isEmpty())
        <p>Keranjang belanja kosong.</p>
    @else
        <div class="row">
            @foreach ($cartItems as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($item->product->image)
                            <img src="{{ Storage::url($item->product->image) }}" class="card-img-top" alt="{{ $item->product->name }}">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->product->name }}</h5>
                            <p class="card-text">Harga: Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                            <p class="card-text">Kuantiti: {{ $item->quantity }}</p>
                            <p class="card-text">Total: Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                            
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
