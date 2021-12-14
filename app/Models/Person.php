<?php

namespace App\Models;

use App\Casts\AuthTokenCustomCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthday'
    ];

    protected $hidden = [
        'pivot'
    ];

    protected $casts = [
        'record_author' => AuthTokenCustomCast::class
    ];

    public function pets(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Pet::class)->withTimestamps();
    }

}
