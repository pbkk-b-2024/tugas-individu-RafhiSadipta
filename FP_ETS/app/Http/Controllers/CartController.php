<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Discount;
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

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function applyDiscount(Request $request)
    {
        // Validasi kode diskon yang diinput
        $request->validate([
            'discount_code' => 'required|string', // Pastikan ini string
        ]);
    
        // Ambil nilai diskon dari request
        $discountCode = $request->input('discount_code');
    
        // Ambil discount dari database
        $discount = Discount::where('code', $discountCode)
                            ->where('start_date', '<=', now())
                            ->where('end_date', '>=', now())
                            ->first();
    
        // Jika diskon tidak valid
        if (!$discount) {
            return redirect()->route('cart.index')->with('error', 'Kode diskon tidak valid atau sudah kadaluarsa.');
        }
    
        // Hitung total pembayaran dari keranjang
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    
        // Hitung nilai diskon yang diterapkan
        $discountAmount = 0;
        if ($discount->type === 'fixed') {
            $discountAmount = min($discount->amount, $totalAmount); // Jangan sampai lebih dari total
        } elseif ($discount->type === 'percentage') {
            $discountAmount = $totalAmount * ($discount->amount / 100);
        }
    
        // Simpan nilai diskon dalam session
        session(['discount_amount' => $discountAmount]);
    
        // Redirect kembali ke cart dengan sukses
        return redirect()->route('cart.index')->with('success', 'Diskon berhasil diterapkan.');
    }
    
    public function checkout(Request $request)
    {
        // Validasi metode pembayaran
        $request->validate([
            'payment_method' => 'required|string',
        ]);
    
        // Ambil semua item keranjang untuk user yang sedang login
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }
    
        // Hitung total pembayaran
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    
        // Cek diskon dari session
        $discountAmount = session('discount_amount', 0);
        $totalAfterDiscount = $totalAmount - $discountAmount;
    
        // Buat pembayaran baru
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'total_amount' => $totalAfterDiscount,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending', // Atur sebagai pending
        ]);
    
        // Buat order baru
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'diproses', // Status default untuk order
            'total_amount' => $totalAfterDiscount, // Total yang sama dengan pembayaran
        ]);
    
        // Simpan order items dari keranjang dan kurangi kuantitas produk
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
    
            // Kurangi kuantitas produk
            $product = Product::find($item->product_id);
            if ($product) {
                $product->quantity -= $item->quantity; // Mengurangi kuantitas
                $product->save(); // Simpan perubahan ke database
            }
        }
    
        // Kosongkan keranjang setelah order berhasil dibuat
        $cartItems->each(function ($item) {
            $item->delete(); // Menghapus item dari keranjang
        });
    
        // Reset diskon setelah pemesanan
        session()->forget('discount_amount');
    
        // Redirect ke halaman order atau keranjang dengan pesan sukses
        return redirect()->route('orders.myOrders')->with('success', 'Pembayaran berhasil diajukan dan pesanan Anda telah dibuat.');
    }
    
}
