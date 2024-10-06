<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::find($id);
    
        // Check if product exists
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);
    
        // Update product details
        $product->update($validatedData);
    
        // Return the updated product
        return response()->json($product, 200);
    }
    

    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if product exists
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Delete the product
        $product->delete();

        // Return a success response
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
