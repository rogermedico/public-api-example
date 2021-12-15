<?php

namespace App\Virtual\Models;

use DateTime;
use Illuminate\Support\Facades\Date;

/**
 * Class PetType
 *
 * @OA\Schema(
 *     title="PetType",
 *     description="Pet type model",
 *     @OA\Xml(
 *         name="PetType"
 *     )
 * )
 */
class PetType
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
     *     title="name",
     *     description="name",
     *     format="string",
     *     example="cat"
     * )
     *
     * @var string
     */
    private $name;

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
