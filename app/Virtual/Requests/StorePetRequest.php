<?php

namespace App\Virtual\Requests;

use Carbon\Traits\Date;

/**
 * @OA\Schema(
 *      title="StorePetRequest",
 *      description="Store Pet request body data",
 *      type="object",
 *      required={"name","pet_type_id"}
 * )
 */
class StorePetRequest
{

    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new Pet",
     *      example="Yuno"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="pet_type_id",
     *      description="FK to the pet type table",
     *      example="1"
     * )
     *
     * @var date
     */
    public $pet_type_id;

}
