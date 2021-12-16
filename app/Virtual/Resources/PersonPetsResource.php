<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="PersonPetsResource",
 *     description="Person Pets resource",
 *     @OA\Xml(
 *         name="PersonPetsResource"
 *     )
 * )
 */
class PersonPetsResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\PersonPet[]
     */
    private $data;

}
