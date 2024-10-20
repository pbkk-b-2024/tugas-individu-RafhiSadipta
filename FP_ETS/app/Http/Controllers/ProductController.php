<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        // Ambil semua kategori dari database
        $categories = Category::all();
    
        // Kirim variabel $categories ke view 'products.create'
        return view('products.create', compact('categories'));
    }    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
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
            'category_id' => $request->category_id,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }    

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Ambil semua kategori dari database
        $categories = Category::all();
    
        // Kirim variabel $categories ke view 'products.edit' bersama dengan produk yang diedit
        return view('products.edit', compact('product', 'categories'));
    }    

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        // Cek apakah ada file gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
            }
    
            // Simpan file gambar
            $imageName = $request->file('image')->store('products', 'public');  // Simpan di folder 'products'
    
            // Update nama file gambar di database
            $product->image = $imageName;
        }
    
        // Update informasi produk
        $product->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $product->image,
            'category_id' => $request->category_id,
        ]);
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }    

    public function destroy(Product $product)
    {
        // Hapus gambar dari storage jika ada
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function katalog(Request $request)
    {
        $categories = Category::all(); // Ambil semua kategori
        
        // Mulai query untuk produk
        $query = Product::query();
    
        // Filter produk berdasarkan kategori
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        
        // Tambahkan filter pencarian produk berdasarkan nama
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%'); // Pencarian berdasarkan nama produk
        }
    
        // Ambil semua produk yang telah difilter
        $products = $query->paginate(6);
        
        return view('pelanggan.katalog', compact('products', 'categories'));
    }    
}
