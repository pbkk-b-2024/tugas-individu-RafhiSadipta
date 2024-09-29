<?php

// database/seeders/AdminSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Membuat role admin jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Membuat user admin
        $admin = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
        ]);

        // Assign role admin ke user tersebut
        $admin->assignRole($adminRole);
    }
}

