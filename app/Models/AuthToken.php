<?php

namespace App\Models;

use App\Casts\AuthTokenCustomCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'auth_token',
    ];

    protected $casts = [
        'auth_token' => AuthTokenCustomCast::class
    ];

}
