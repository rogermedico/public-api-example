<?php

namespace Database\Seeders;

use App\Models\Pet;
use Illuminate\Database\Seeder;

class PetsSeeder extends Seeder
{

    private $pets = [
        [
            'name' => 'yuno',
            'pet_type_id' => 1,
        ],
        [
            'name' => 'arya',
            'pet_type_id' => 1,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->pets as $pet)
        {
            Pet::create(array_merge(
                $pet,
                [
                    'record_author' => env('API_MASTER_KEY')
                ]
            ));
        }

    }
}
