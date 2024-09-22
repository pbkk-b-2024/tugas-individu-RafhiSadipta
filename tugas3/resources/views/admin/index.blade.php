@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar User</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th> <!-- Tambahkan kolom untuk role -->
                <th>Last Login</th> <!-- Tambahkan kolom untuk last login -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->first()->name ?? 'Tidak ada role' }}</td> <!-- Menampilkan role -->
                    <td>{{ $user->last_login ?? 'Belum Pernah Login' }}</td> <!-- Menampilkan last login -->
                    <td>
                        <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.destroy', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
