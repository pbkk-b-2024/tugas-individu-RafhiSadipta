@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @role('admin')
            <div class="col-md-4 mb-4">
                <a href="{{ route('products.index') }}" class="text-decoration-none">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Kelola Produk
                            <i class="fas fa-boxes float-end"></i>
                            <h4>{{ $productCount }} Produk</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('categories.index') }}" class="text-decoration-none">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Kelola Kategori
                            <i class="fas fa-folder float-end"></i>
                            <h4>{{ $categoryCount }} Kategori</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('admin.index') }}" class="text-decoration-none">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Kelola User
                            <i class="fas fa-users float-end"></i>
                            <h4>{{ $userCount }} Users</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('orders.admin') }}" class="text-decoration-none">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Daftar Pesanan
                            <i class="fas fa-file-invoice float-end"></i>
                            <h4>{{ $orderCount }} Orders</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('discounts.index') }}" class="text-decoration-none">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Daftar Diskon
                            <i class="fas fa-tags float-end"></i>
                            <h4>{{ $discountCount }} Diskon</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ url('/api/schema') }}" class="text-decoration-none">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            API Schema
                            <i class="fas fa-code float-end"></i>
                            <h4>Documented</h4>
                        </div>
                    </div>
                </a>
            </div>
        @endrole

        @role('pelanggan')
            <div class="col-md-4 mb-4">
                <a href="{{ route('products.katalog') }}" class="text-decoration-none">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Lihat Katalog
                            <i class="fas fa-store float-end"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('profile.edit') }}" class="text-decoration-none">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Profil
                            <i class="fas fa-user float-end"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('cart.index') }}" class="text-decoration-none">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Daftar Keranjang
                            <i class="fas fa-shopping-cart float-end"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('orders.myOrders') }}" class="text-decoration-none">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Daftar Pesanan
                            <i class="fas fa-receipt float-end"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ url('/api/schema') }}" class="text-decoration-none">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            API Schema
                            <i class="fas fa-code float-end"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endrole
    </div>
</div>
@endsection
