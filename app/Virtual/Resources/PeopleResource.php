<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="PeopleResource",
 *     description="People resource",
 *     @OA\Xml(
 *         name="PeopleResource"
 *     )
 * )
 */
class PeopleResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Person[]
     */
    private $data;

}
