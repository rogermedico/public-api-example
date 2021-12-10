<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\PersonPet;
use App\Models\Pet;
use App\Models\PetType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class HomeController extends Controller
{

    private function getTablesInformation(): array
    {
        return [
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
        ];
    }

    private function getApiRoutePaths($startingWith = '')
    {
        return collect(Route::getRoutes())->reduce(function ($carry, $route) use ($startingWith) {
//            !str_starts_with($route->uri(), $startingWith) ?: $carry[] = $route->uri();
            if(str_starts_with($route->uri(), $startingWith))
            {
                $carry[] = (object) [
                    'methods' => $route->methods(),
                    'uri' => $route->uri()
                ];
            }

            return  $carry;
        });
    }

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
                'db' => $this->getTablesInformation(),
                'routes' => $this->getApiRoutePaths('api')
            ]
        );
    }
}
