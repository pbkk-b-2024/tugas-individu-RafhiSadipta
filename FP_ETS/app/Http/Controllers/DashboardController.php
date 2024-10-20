<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Discount;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah produk, kategori, user, pesanan, dan diskon
        $productCount = Product::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $orderCount = Order::count();
        $discountCount = Discount::count();

        // Kirim data ke view
        return view('dashboard', compact('productCount', 'categoryCount', 'userCount', 'orderCount', 'discountCount'));
    }
}
