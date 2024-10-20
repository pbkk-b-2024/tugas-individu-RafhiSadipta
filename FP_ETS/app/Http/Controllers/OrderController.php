<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Method untuk membuat order dari cart
    public function createOrder(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }
    
        // Hitung total amount
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    
        // Buat order baru
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'diproses', // Status default
            'total_amount' => $totalAmount,
        ]);
    
        // Simpan order items dan kurangi kuantitas produk
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
    
            // Kurangi kuantitas produk sesuai dengan order
            $product = Product::find($item->product_id);
            
            if ($product) {
                $product->quantity -= $item->quantity; // Mengurangi kuantitas
                $product->save(); // Simpan perubahan ke database
            }
        }
    
        // Kosongkan keranjang setelah order berhasil dibuat
        $cartItems->each->delete();
    
        return redirect()->route('orders.pelanggan')->with('success', 'Order berhasil dibuat.');
    }    

    // Method untuk melihat semua order untuk admin
    public function index()
    {
        $orders = Order::with('user')->get(); // Ambil semua order dengan relasi user
        return view('orders.admin', compact('orders'));
    }

    // Method untuk mengubah status order
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|string']);

        $order->update(['status' => $request->status]);

        return redirect()->route('orders.admin')->with('success', 'Status order berhasil diperbarui.');
    }

    // Method untuk pelanggan melihat order mereka
    public function myOrders()
    {
        // Fetch the user's orders along with related products and reviews
        $orders = Order::where('user_id', Auth::id())
                       ->with(['orderItems.product.reviews' => function ($query) {
                            $query->where('user_id', Auth::id()); // Fetch only user's own reviews
                       }])->get();
    
        return view('orders.pelanggan', compact('orders'));
    }    

    // Method untuk menyelesaikan order
    public function completeOrder(Order $order)
    {
        $order->update(['status' => 'selesai']); // Ubah status menjadi 'selesai'
        return redirect()->route('orders.myOrders')->with('success', 'Order telah diselesaikan.');
    }

    public function show(Order $order)
    {
        // Pastikan pengguna adalah pemilik order atau admin
        if ($order->user_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
            abort(403); // Akses ditolak
        }
    
        // Mengambil item terkait untuk pesanan ini
        $orderItems = $order->orderItems()->with('product')->get();
    
        return view('orders.detail', compact('order', 'orderItems'));
    }    

    public function adminshow(Order $order)
    {
        // Mengambil semua item dalam order dan produk yang terkait
        $orderItems = $order->orderItems()->with('product')->get();
    
        return view('orders.detail', compact('order', 'orderItems'));
    }
    
}
