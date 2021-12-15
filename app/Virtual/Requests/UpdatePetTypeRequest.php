<?php

namespace App\Virtual\Requests;

use Carbon\Traits\Date;

/**
 * @OA\Schema(
 *      title="UpdatePetTypeRequest",
 *      description="Update Pet Type request body data",
 *      type="object",
 * )
 */
class UpdatePetTypeRequest
{

    /**
     * @OA\Property(
     *      title="name",
     *      description="Updated ame for pet type",
     *      example="Lion"
     * )
     *
     * @var string
     */
    public $name;

}
