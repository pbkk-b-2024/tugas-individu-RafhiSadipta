<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Mass assignable fields
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    // Relasi: User dimiliki oleh satu Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
