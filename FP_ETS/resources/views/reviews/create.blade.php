@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tulis Review untuk Pesanan #{{ $order->id }}</h1>

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        
        @foreach ($order->orderItems as $item)
            <div class="mb-3">
                <h5>{{ $item->product->name }}</h5>
                <label for="rating_{{ $item->product->id }}" class="form-label">Rating</label>
                <select name="reviews[{{ $loop->index }}][rating]" id="rating_{{ $item->product->id }}" class="form-select">
                    <option value="1">1 - Sangat Buruk</option>
                    <option value="2">2 - Buruk</option>
                    <option value="3">3 - Cukup</option>
                    <option value="4">4 - Baik</option>
                    <option value="5">5 - Sangat Baik</option>
                </select>

                <label for="review_{{ $item->product->id }}" class="form-label">Review</label>
                <textarea name="reviews[{{ $loop->index }}][review]" id="review_{{ $item->product->id }}" class="form-control" rows="4" required></textarea>
                <input type="hidden" name="reviews[{{ $loop->index }}][product_id]" value="{{ $item->product->id }}">
                <input type="hidden" name="reviews[{{ $loop->index }}][order_item_id]" value="{{ $item->id }}"> <!-- Tambahkan ini -->
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Kirim Review</button>
    </form>
</div>
@endsection
