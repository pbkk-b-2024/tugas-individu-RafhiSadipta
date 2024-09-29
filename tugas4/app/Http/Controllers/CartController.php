<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menambah produk ke keranjang
    public function addToCart(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->quantity,
        ]);

        // Tambahkan atau perbarui produk di keranjang
        Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $product->id],
            ['quantity' => $request->quantity]
        );

        return redirect()->route('products.katalog')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Tampilkan keranjang pengguna
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        return view('pelanggan.cart', compact('cartItems'));
    }

    // Hapus produk dari keranjang
    public function removeFromCart(Cart $cart)
    {
        if ($cart->user_id === Auth::id()) {
            $cart->delete();
        }

        return redirect()->route('products.cart')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}

