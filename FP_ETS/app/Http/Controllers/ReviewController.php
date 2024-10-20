<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($order_id)
    {
        $order = Order::with('orderItems.product')->findOrFail($order_id); // Eager load order items with products
        return view('reviews.create', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reviews' => 'required|array',
            'reviews.*.product_id' => 'required|exists:products,id',
            'reviews.*.order_item_id' => 'required|exists:order_items,id', // Validasi order_item_id
            'reviews.*.rating' => 'required|integer|min:1|max:5',
            'reviews.*.review' => 'required|string|max:255',
        ]);
    
        // Iterate through each review input
        foreach ($request->reviews as $reviewData) {
            Review::create([
                'order_id' => $request->order_id,
                'user_id' => Auth::id(),
                'product_id' => $reviewData['product_id'],
                'order_item_id' => $reviewData['order_item_id'], // Tambahkan ini
                'rating' => $reviewData['rating'],
                'review' => $reviewData['review'],
            ]);
        }
    
        return redirect()->route('reviews.index', $request->order_id)->with('success', 'Review berhasil ditambahkan.');
    }     

    public function show($orderId)
    {
        $order = Order::with('orderItems.product.reviews')->findOrFail($orderId);
        
        // Ensure that only orders with 'selesai' status have reviews displayed
        if ($order->status !== 'selesai') {
            return redirect()->back()->with('error', 'Review hanya tersedia untuk pesanan yang sudah selesai.');
        }

        return view('reviews.index', compact('order'));
    }

    public function index($order_id)
    {
        $user = Auth::user();
        
        // Find the order by ID
        $order = Order::with('orderItems.product')
            ->findOrFail($order_id); // Retrieve the specific order or fail
    
        // Check if the user is an admin
        if ($user->hasRole('admin')) {
            // No need to filter by user, just show the specific order's reviews
            // The order is already retrieved above
        } else {
            // Ensure the order belongs to the authenticated customer
            if ($order->user_id !== $user->id) {
                return redirect()->back()->with('error', 'Anda tidak memiliki hak akses untuk melihat review ini.');
            }
        }

        $reviews = Review::where('order_id', $order_id)->get();
    
        return view('reviews.index', compact('order', 'reviews'));
    }
    
}

