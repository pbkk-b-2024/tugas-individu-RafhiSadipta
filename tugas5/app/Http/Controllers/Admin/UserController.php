<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        // Mengambil semua user
        $users = User::with('roles')->get();
        return view('admin.index', compact('users'));
    }

    // Menampilkan form untuk mengedit user
    public function edit($id)
    {
        // Mengambil user berdasarkan id
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    // Update data user
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // Mengambil user dan mengupdate datanya
        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.index')->with('success', 'User berhasil diupdate.');
    }

    // Menghapus user
    public function destroy($id)
    {
        // Mengambil user dan menghapusnya
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User berhasil dihapus.');
    }
}
