@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Diskon Baru</h1>

    <form action="{{ route('discounts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="code">Kode Diskon</label>
            <input type="text" name="code" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="amount">Jumlah Diskon</label>
            <input type="number" name="amount" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="type">Tipe Diskon</label>
            <select name="type" class="form-control" required>
                <option value="fixed">Tetap</option>
                <option value="percentage">Persentase</option>
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">Tanggal Berakhir</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Diskon</button>
    </form>
</div>
@endsection
