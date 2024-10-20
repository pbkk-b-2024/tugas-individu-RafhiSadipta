<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara massal
    protected $fillable = ['name', 'description'];

    // Relasi One-to-Many dengan produk (satu kategori bisa memiliki banyak produk)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
