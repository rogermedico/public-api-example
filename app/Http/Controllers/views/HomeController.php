<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\PersonPet;
use App\Models\Pet;
use App\Models\PetType;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): View
    {

        return view(
            'home',
            [
                'db' => [
                    (object) [
                        'model' => new Person(),
                        'data' => Person::all(),
                        'hint' => __('Holds people information.')
                    ],
                    (object) [
                        'model' => new Pet(),
                        'data' => Pet::all(),
                        'hint' => __('Holds pets information.')
                    ],
                    (object) [
                        'model' => new PetType(),
                        'data' => PetType::all(),
                        'hint' => __('Holds pet types information.')
                    ],
                    (object) [
                        'model' => new PersonPet(),
                        'data' => PersonPet::all(),
                        'hint' => __('Holds the relations between people and pets.')
                    ]
                ]
            ]
        );
    }
}
