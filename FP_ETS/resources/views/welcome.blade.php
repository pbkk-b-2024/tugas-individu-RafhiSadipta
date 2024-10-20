<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Grocery Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://asset.kompas.com/crops/-7YAp8NxWASTpxdlUo6kprWL2zk=/50x405:3979x3024/750x500/data/photo/2021/08/09/61111b860beb7.jpg'); /* Ganti dengan URL gambar Anda */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            margin: 0;
            padding-top: 0;
        }
        .background-blur {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 150vh;
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.2);
            z-index: -1;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px; /* Tambahkan margin-bottom untuk jarak dari footer */
            position: relative;
            z-index: 1;
        }
        h1, h2, p {
            margin: 0 0 15px;
        }
        .btn {
            margin-right: 10px;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .col-md-6.text-center {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 30px;
            padding-bottom: 30px;
        }
        .header .container {
            max-width: 100%; /* Membuat lebar container penuh */
            padding: 10px 20px; /* Sedikit padding dalam container */
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
        /* Footer styling */
        .footer {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            text-align: center;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }
        .map-container {
            width: 100%;
            height: 200px;
            border: 0;
        }
    </style>
</head>
<body>

<!-- Header Section -->
<header class="header">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Supermarket name (styled as requested) -->
        <div class="supermarket-title">
            <span class="font-weight-bold">Supermarket</span>
            <span>Sinar Jaya</span>
        </div>
        <!-- Navigation bar -->
        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Contacts</a></li>
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Background Blur -->
<div class="background-blur"></div>

<!-- Main Content -->
<div class="container"> <!-- Menambahkan margin-top dan margin-bottom pada container -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="display-4">Online Shop</h1>
            <h2 class="text-primary">Supermarket Sinar Jaya</h2>
            <p class="lead">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation.
            </p>
            <div class="mt-4">
                <a href="{{ route('register') }}" class="btn btn-danger btn-lg">Register Now!</a>
                <a href="{{ route('login') }}" class="btn btn-danger btn-lg">Login Now!</a>
            </div>
            <div class="mt-5">
                <h5>24/7</h5>
                <p>Your grocery store at any time!</p>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('image/groceries.png') }}" alt="Shopping Bag">
        </div>
    </div>
</div>

<!-- Footer Section -->
<footer class="footer">
    <div class="container">
        <p class="mb-0">&copy; 2024 Supermarket Sinar Jaya</p>
        <p>Contacts: 123-456-789 | Address: 123 Main Street</p>
        <!-- Google Maps embedded iframe -->
        <iframe class="map-container" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509374!2d144.95373511531666!3d-37.81627917975195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d43f1f1f1f1%3A0xe7f20f0ffebf83a1!2s123%20Main%20St%2C%20Melbourne%20VIC%203000%2C%20Australia!5e0!3m2!1sen!2sus!4v1617078086352!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
