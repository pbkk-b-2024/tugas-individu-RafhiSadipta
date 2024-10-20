<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories')); // Tampilkan di view
    }

    // Menampilkan form untuk menambah kategori baru
    public function create()
    {
        return view('categories.create'); // Tampilkan form untuk membuat kategori
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Simpan kategori
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect ke halaman kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category')); // Tampilkan form edit kategori
    }

    // Memperbarui kategori di database
    public function update(Request $request, Category $category)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Update kategori
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect ke halaman kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori dari database
    public function destroy(Category $category)
    {
        // Hapus kategori
        $category->delete();

        // Redirect ke halaman kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
