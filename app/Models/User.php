<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Socialite\Facades\Socialite;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar'
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }
}