<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Pet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PersonPetSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* fill pivot from person */
        Person::firstWhere('name','roger')
            ->pets()
            ->attach(
                Pet::firstWhere('name','yuno'),
                [
                    'adopted' => Carbon::createFromDate(2013,3,5)
                ]
            );

        /* fill pivot from pet */
        Pet::firstWhere('name','arya')
            ->persons()
            ->attach(
                Person::firstWhere('name','magda'),
                [
                    'adopted' => Carbon::createFromDate(2015,5,13)
                ]
            );
    }
}
