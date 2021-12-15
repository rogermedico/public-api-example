<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="PetsWithRelationsPersonsResource",
 *     description="Pets resource with relations and owners",
 *     @OA\Xml(
 *         name="PetsWithRelationsPersonsResource"
 *     )
 * )
 */
class PetsWithRelationsPersonsResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\PetWithRelationsPersons[]
     */
    private $data;

}
