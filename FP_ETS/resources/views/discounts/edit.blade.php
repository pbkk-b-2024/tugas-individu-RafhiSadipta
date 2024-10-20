@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Diskon</h1>

    <form action="{{ route('discounts.update', $discount->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code">Kode Diskon</label>
            <input type="text" name="code" class="form-control" value="{{ $discount->code }}" required>
        </div>
        <div class="form-group">
            <label for="amount">Jumlah Diskon</label>
            <input type="number" name="amount" class="form-control" value="{{ $discount->amount }}" required>
        </div>
        <div class="form-group">
            <label for="type">Tipe Diskon</label>
            <select name="type" class="form-control" required>
                <option value="fixed" {{ $discount->type == 'fixed' ? 'selected' : '' }}>Tetap</option>
                <option value="percentage" {{ $discount->type == 'percentage' ? 'selected' : '' }}>Persentase</option>
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" value="{{ $discount->start_date }}" required>
        </div>
        <div class="form-group">
            <label for="end_date">Tanggal Berakhir</label>
            <input type="date" name="end_date" class="form-control" value="{{ $discount->end_date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui Diskon</button>
    </form>
</div>
@endsection
