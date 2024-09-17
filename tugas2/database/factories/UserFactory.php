<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role; // Pastikan untuk mengimpor model Role jika ada relasi
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Default password
            'role_id' => Role::inRandomOrder()->first()->id, // Menentukan role_id acak
        ];
    }
}
