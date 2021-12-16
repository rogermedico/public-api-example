<?php

namespace App\Virtual\Requests;

use Carbon\Traits\Date;

/**
 * @OA\Schema(
 *      title="UpdatePersonPetRequest",
 *      description="Update Person Pet request body data",
 *      type="object"
 * )
 */
class UpdatePersonPetRequest
{

    /**
     * @OA\Property(
     *     title="person_id",
     *     description="person_id",
     *     format="int64",
     *     example=2
     * )
     *
     * @var integer
     */
    private $person_id;

    /**
     * @OA\Property(
     *     title="pet_id",
     *     description="pet_id",
     *     format="int64",
     *     example=7
     * )
     *
     * @var integer
     */
    private $pet_id;

    /**
     * @OA\Property(
     *     title="adoption",
     *     description="the date when the owner adopted the pet",
     *     format="date",
     *     example="1989-11-17"
     * )
     *
     * @var Date
     */
    private $adopted;

}
