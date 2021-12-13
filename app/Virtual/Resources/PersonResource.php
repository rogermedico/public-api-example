<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="PersonResource",
 *     description="Person resource",
 *     @OA\Xml(
 *         name="PersonResource"
 *     )
 * )
 */
class PersonResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Person
     */
    private $data;

}
