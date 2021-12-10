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
        [
            'id' => 3,
            'name' => 'tortoise'
        ],
        [
            'id' => 4,
            'name' => 'parrot'
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
