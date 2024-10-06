<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'productId' => 'required|exists:products,id',  // Ensure the product exists
            'quantity' => 'required|integer|min:1',        // Ensure the quantity is valid
        ]);

        // Fetch the product by productId
        $product = Product::find($validatedData['productId']);

        // Get the authenticated user
        $user = auth()->user();

        // Check if the product is already in the user's cart
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            // If the product is already in the cart, update the quantity
            $cartItem->quantity += $validatedData['quantity'];
            $cartItem->save();
        } else {
            // If the product is not in the cart, create a new cart item
            $cartItem = Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $validatedData['quantity'],
            ]);
        }

        // Return a response with the updated cart item
        return response()->json([
            'message' => 'Product added to cart',
            'cartItem' => $cartItem,
        ], 200);
    }

    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return response()->json($cartItems);
    }
}
