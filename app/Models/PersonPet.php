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
        'adopted',
        'token_id'
    ];

    protected $hidden = [

    ];

}
