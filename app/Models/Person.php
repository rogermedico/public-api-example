<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthday',
        'token_id',
    ];

    protected $hidden = [
        'pivot'
    ];

    protected $casts = [
        'token_id' => 'integer'
    ];

    public function pets(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Pet::class)->withTimestamps();
    }

}
