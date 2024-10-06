<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Simpan file gambar
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');  // Simpan di folder 'products'
        }
    
        // Simpan produk ke database
        Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $imageName,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }    

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Cek apakah ada file gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
            }
    
        // Simpan file gambar
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('products', 'public');  // Simpan di folder 'products'
        }
    
            // Update nama file gambar di database
            $product->image = $imageName;
        }
    
        // Update informasi produk
        $product->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $product->image,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }    

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function katalog()
    {
        $products = Product::all();
        return view('pelanggan.katalog', compact('products'));
    }
}
