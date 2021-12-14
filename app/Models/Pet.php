<?php

namespace App\Models;

use App\Casts\AuthTokenCustomCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type'
    ];

    protected $hidden = [
        'pivot',
    ];

    protected $casts = [
        'record_author' => AuthTokenCustomCast::class
    ];

    public function type(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PetType::class);
    }

    public function persons(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Person::class)->withTimestamps();
    }

}
