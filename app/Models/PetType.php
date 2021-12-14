<?php

namespace App\Models;

use App\Casts\AuthTokenCustomCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'record_author' => AuthTokenCustomCast::class
    ];
}
