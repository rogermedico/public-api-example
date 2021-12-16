<?php

namespace App\Virtual\Models;

use DateTime;
use Illuminate\Support\Facades\Date;

/**
 * Class PersonPet
 *
 * @OA\Schema(
 *     title="PersonPet",
 *     description="PersonPet model",
 *     @OA\Xml(
 *         name="PersonPet"
 *     )
 * )
 */
class PersonPet
{

    /**
     * @OA\Property(
     *     title="id",
     *     description="id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

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

    /**
     * @OA\Property(
     *     title="token_id",
     *     description="token id identifying the author of the request",
     *     format="int64",
     *     example="10"
     * )
     *
     * @var integer
     */
    private $token_id;

    /**
     * @OA\Property(
     *     title="created_at",
     *     description="when record was created",
     *     format="datetime",
     *     example="2021-12-10T10:31:23.000000Z"
     * )
     *
     * @var datetime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="updated_at",
     *     description="when record was updated",
     *     format="datetime",
     *     example="2021-12-10T10:31:23.000000Z"
     * )
     *
     * @var datetime
     */
    private $updated_at;

}
