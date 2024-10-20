<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Supermarket</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .header {
            position: relative;
            top: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0px 4px 2px -2px gray;
        }
        footer.footer {
            width: 100%;
            padding: 10px 0;
            background-color: #f8f9fa;
        }
        /* Sidebar styling */
        #sidebar {
            height: 100vh;
            background-color: #e9ecef; /* Warna abu-abu */
            padding-top: 20px;
        }
        #sidebar .nav-item {
            padding: 10px 15px;
            font-size: 16px;
        }
        #sidebar .nav-item a {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        #sidebar .nav-item a:hover {
            background-color: #dcdcdc;
            border-radius: 5px;
        }
        #sidebar .nav-item.active a {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        #sidebar .nav-item.active a:hover {
            background-color: #0056b3;
        }
        .supermarket-title {
            font-size: 24px;
            line-height: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Hanya blok putih untuk nama supermarket */
            padding: 10px 20px; /* Beri ruang di sekitar teks */
            border-radius: 10px; /* Sudut yang melengkung */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Sedikit bayangan */
        }
        .supermarket-title span {
            display: block;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Header -->
        <header class="header">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/dashboard') }}">
                    <div class="supermarket-title">
                        <span class="font-weight-bold">Supermarket</span>
                        <span>Sinar Jaya</span>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Nama Pengguna Login -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        </header>

        <!-- Main Layout: Sidebar and Content -->
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky">
                        <ul class="nav flex-column">
                            @auth
                                <!-- Jika pengguna sudah login dan merupakan admin, tampilkan link Kelola Produk dan User -->
                                @role('admin')
                                    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('dashboard') }}">
                                            <span class="icon">🏠</span> Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('products*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('products.index') }}">
                                            <span class="icon">📦</span> Kelola Produk
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('categories*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('categories.index') }}">
                                            <span class="icon">📂</span> Kelola Kategori
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('admin*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('admin.index') }}">
                                            <span class="icon">👤</span> Kelola User
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('orders*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('orders.admin') }}">
                                            <span class="icon">📑</span> Daftar Pesanan
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('discounts*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('discounts.index') }}">
                                            <span class="icon">🏷️</span> Daftar Diskon
                                        </a>
                                    </li>
                                @endrole

                                <!-- Jika pengguna berperan sebagai pelanggan, tampilkan link untuk katalog produk dan profil -->
                                @role('pelanggan')
                                    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('dashboard') }}">
                                            <span class="icon">🏠</span> Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('profile') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('profile.edit') }}">
                                            <span class="icon">👤</span> Profil
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('katalog') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('products.katalog') }}">
                                            <span class="icon">🛍️</span> Lihat Katalog
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('cart*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('cart.index') }}">
                                            <span class="icon">🛒</span> Daftar Keranjang
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->is('my-orders') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('orders.myOrders') }}">
                                            <span class="icon">📑</span> Daftar Pesanan
                                        </a>
                                    </li>
                                @endrole

                                 <!-- Link for API Schema -->
                                <li class="nav-item {{ request()->is('api/schema') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ url('/api/schema') }}">
                                        <span class="icon">🗒️</span> API Schema
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </nav>

                <!-- Main Content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                    @yield('content')
                </main>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer mt-auto py-3 bg-secondary">
            <div class="container text-center">
                <span class="text-white">© {{ date('Y') }} Supermarket. All rights reserved.</span>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</body>
</html>
