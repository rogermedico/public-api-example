<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="PetWithRelationsPersonsResource",
 *     description="Pet resource with relations and owners",
 *     @OA\Xml(
 *         name="PetWithRelationsPersonsResource"
 *     )
 * )
 */
class PetWithRelationsPersonsResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\PetWithRelationsPersons
     */
    private $data;

}
