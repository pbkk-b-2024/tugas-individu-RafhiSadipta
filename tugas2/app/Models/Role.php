<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = ['name'];

    // Relasi: Role memiliki banyak User
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
