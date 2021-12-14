<?php

namespace App\Virtual\Requests;

use Carbon\Traits\Date;

/**
 * @OA\Schema(
 *      title="UpdatePetRequest",
 *      description="Update Pet request body data",
 *      type="object",
 * )
 */
class UpdatePetRequest
{

    /**
     * @OA\Property(
     *      title="name",
     *      description="New name for the updated Pet",
     *      example="Yuno"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="pet_type_id",
     *      description="New FK to the pet id for the updated Pet",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $birthday;

}
