<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PeopleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $persons = [
            [
                'name' => 'roger',
                'birthday' => Carbon::createFromDate(1989,11,17),
            ],
            [
                'name' => 'magda',
                'birthday' => Carbon::createFromDate(1994,10,27),
            ],
        ];

        foreach ($persons as $person)
        {
            Person::create($person);
        }

    }
}
