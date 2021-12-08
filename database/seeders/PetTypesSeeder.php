<?php

namespace Database\Seeders;

use App\Models\PetType;
use Illuminate\Database\Seeder;

class PetTypesSeeder extends Seeder
{

    private $petTypes = [
        [
            'id' => 1,
            'name' => 'cat'
        ],
        [
            'id' => 2,
            'name' => 'dog'
        ],
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach($this->petTypes as $petType)
        {
            PetType::create($petType);
        }

    }
}
