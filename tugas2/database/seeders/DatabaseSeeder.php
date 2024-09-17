<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed tabel roles dan users
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
