<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="PetsResource",
 *     description="Pets resource",
 *     @OA\Xml(
 *         name="PetsResource"
 *     )
 * )
 */
class PetResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Pet
     */
    private $data;

}
