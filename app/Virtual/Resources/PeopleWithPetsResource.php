<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="PeopleWithPetsResource",
 *     description="People resource with pets",
 *     @OA\Xml(
 *         name="PeopleWithPtsResource"
 *     )
 * )
 */
class PeopleWithPetsResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\PersonWithPets[]
     */
    private $data;

}
