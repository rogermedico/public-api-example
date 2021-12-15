<?php

namespace App\Virtual\Requests;

use Carbon\Traits\Date;

/**
 * @OA\Schema(
 *      title="StorePetTypeRequest",
 *      description="Store Pet Type request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StorePetTypeRequest
{

    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new pet type",
     *      example="cat"
     * )
     *
     * @var string
     */
    public $name;

}
