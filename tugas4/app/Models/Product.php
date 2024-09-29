<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tentukan kolom yang bisa diisi melalui mass assignment
    protected $fillable = ['name', 'quantity', 'price'];
}
