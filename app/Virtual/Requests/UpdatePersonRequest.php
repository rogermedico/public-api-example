<?php

namespace App\Virtual\Requests;


use Carbon\Traits\Date;

/**
 * @OA\Schema(
 *      title="UpdatePersonRequest",
 *      description="Update Person request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdatePersonRequest
{

    /**
     * @OA\Property(
     *      title="name",
     *      description="New name for the updated person",
     *      example="Roger"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="birthday",
     *      description="New birthday for the updated person",
     *      example="1990-5-30"
     * )
     *
     * @var date
     */
    public $birthday;

}
