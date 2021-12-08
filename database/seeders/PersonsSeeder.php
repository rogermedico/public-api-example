<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Pet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PersonsSeeder extends Seeder
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
//                ->pets()
//                ->attach(
//                    Pet::where('name','yuno')->get(),
//                    [
//                        'adopted' => Carbon::createFromDate(2013,3,5)
//                    ]
//                );

        }

    }
}
