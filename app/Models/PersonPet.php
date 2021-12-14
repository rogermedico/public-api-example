<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonPet extends Model
{
    use HasFactory;

    protected $table = 'person_pet';

    protected $fillable = [
        'person_id',
        'pet_id',
        'adopted'
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'token_id' => 'integer'
    ];

}
