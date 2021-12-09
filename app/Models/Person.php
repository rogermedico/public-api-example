<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

//    protected $table = 'persons';

    private $helper = 'asdf';

    protected $fillable = [
        'id',
        'name',
        'birthday',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'pivot',
    ];

    public function pets(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Pet::class)->withTimestamps();
    }

    public function getHelper()
    {
        return $this->helper;
    }

}
