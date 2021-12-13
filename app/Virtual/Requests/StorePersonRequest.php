<?php

namespace App\Virtual\Requests;

use Carbon\Traits\Date;

/**
 * @OA\Schema(
 *      title="StorePersonRequest",
 *      description="Store Person request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class StorePersonRequest
{

    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new person",
     *      example="Roger"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="birthday",
     *      description="Birthday of the new person",
     *      example="1990-5-30"
     * )
     *
     * @var date
     */
    public $birthday;

}
