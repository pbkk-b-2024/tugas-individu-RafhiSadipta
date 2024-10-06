<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method == 'PUT')
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="name">Nama Produk</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name ?? '' }}" required>
    </div>

    <div class="form-group">
        <label for="quantity">Kuantiti</label>
        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity ?? '' }}" required>
    </div>

    <div class="form-group">
        <label for="price">Harga</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price ?? '' }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
