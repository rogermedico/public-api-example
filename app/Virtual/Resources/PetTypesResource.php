<?php

namespace App\Virtual\Resources;

use DateTime;
use Illuminate\Support\Facades\Date;

/**
 * Class PetTypesResource
 *
 * @OA\Schema(
 *     title="PetTypesResource",
 *     description="Pet types resource",
 *     @OA\Xml(
 *         name="PetTypesResource"
 *     )
 * )
 */
class PetTypesResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\PetType[]
     */
    private $data;

}
