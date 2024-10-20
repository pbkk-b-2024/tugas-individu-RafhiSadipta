<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    // Menampilkan daftar diskon
    public function index()
    {
        $discounts = Discount::all(); // Mengambil semua diskon
        return view('discounts.index', compact('discounts'));
    }

    // Menampilkan form untuk membuat diskon baru
    public function create()
    {
        return view('discounts.create');
    }

    // Menyimpan diskon baru
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:discounts',
            'amount' => 'required|numeric',
            'type' => 'required|in:fixed,percentage',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Discount::create($request->all());
        return redirect()->route('discounts.index')->with('success', 'Diskon berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit diskon
    public function edit(Discount $discount)
    {
        return view('discounts.edit', compact('discount'));
    }

    // Memperbarui diskon
    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'code' => 'required|string|unique:discounts,code,' . $discount->id,
            'amount' => 'required|numeric',
            'type' => 'required|in:fixed,percentage',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $discount->update($request->all());
        return redirect()->route('discounts.index')->with('success', 'Diskon berhasil diperbarui.');
    }

    // Menghapus diskon
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'Diskon berhasil dihapus.');
    }
}
