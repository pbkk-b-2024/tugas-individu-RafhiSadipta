<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Admin'],
            ['name' => 'Editor'],
            ['name' => 'Viewer'],
            ['name' => 'Moderator'],
            ['name' => 'Contributor'],
            ['name' => 'Subscriber'],
            ['name' => 'Guest'],
            ['name' => 'Manager'],
            ['name' => 'Analyst'],
            ['name' => 'Developer'],
            ['name' => 'Designer'],
            ['name' => 'Support'],
            ['name' => 'HR'],
            ['name' => 'Accountant'],
            ['name' => 'Sales'],
            ['name' => 'Marketing'],
        ]);
    }
}
