<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="PersonWithPetsResource",
 *     description="Person resource with pets",
 *     @OA\Xml(
 *         name="PersonWithPetsResource"
 *     )
 * )
 */
class PersonWithPetsResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\PersonWithPets
     */
    private $data;

}
