<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pet_type_id',
        'token_id'
    ];

    protected $hidden = [
        'pivot',
    ];

    public function type(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PetType::class);
    }

    public function persons(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Person::class,'person_pet')->withPivot('adopted')->withTimestamps();
    }

}
