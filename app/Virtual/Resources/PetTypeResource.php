<?php

namespace App\Virtual\Resources;

use DateTime;
use Illuminate\Support\Facades\Date;

/**
 * Class PetTypeResource
 *
 * @OA\Schema(
 *     title="PetTypeResource",
 *     description="Pet type resource",
 *     @OA\Xml(
 *         name="PetTypeResource"
 *     )
 * )
 */
class PetTypeResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\PetType
     */
    private $data;

}
