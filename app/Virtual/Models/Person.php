<?php

namespace App\Virtual\Models;

use DateTime;
use Illuminate\Support\Facades\Date;

/**
 * Class Person
 *
 * @OA\Schema(
 *     title="Person",
 *     description="Person model",
 *     @OA\Xml(
 *         name="Person"
 *     )
 * )
 */
class Person
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
     *     example="Roger Medico"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     title="birthday",
     *     description="birthday",
     *     format="date",
     *     example="1989-11-17"
     * )
     *
     * @var Date
     */
    private $birthday;

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
