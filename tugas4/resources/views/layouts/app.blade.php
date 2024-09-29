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
    </style>
</head>
<body>
    <div id="app">
        <!-- Header -->
        <header class="header">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Supermarket
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
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('products.index') }}">Kelola Produk</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.index') }}">Kelola User</a>
                                    </li>
                                @endrole

                                <!-- Jika pengguna berperan sebagai pelanggan, tampilkan link untuk katalog produk dan profil -->
                                @role('pelanggan')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('products.katalog') }}">Lihat Katalog</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('profile.edit') }}">Profil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('cart.index') }}">Daftar Keranjang</a>
                                    </li>
                                @endrole

                                 <!-- Link for API Schema -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/api/schema') }}">API Schema</a>
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
