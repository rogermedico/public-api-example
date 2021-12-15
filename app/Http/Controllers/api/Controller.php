<?php

namespace App\Http\Controllers\api;

class Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Public API Example Documentation",
     *      description="L5 Swagger OpenApi description",
     *      @OA\Contact(
     *          email="roger.medico@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="API Server"
     * )
     *
     * @OA\Tag(
     *      name="People",
     *      description="API Endpoints of People"
     * )
     *
     * @OA\Tag(
     *      name="Pets",
     *      description="API Endpoints of Pets"
     * )
     *
     * @OA\Tag(
     *      name="Pet Types",
     *      description="API Endpoints of Pet Types"
     * )
     *
     * @OA\SecurityScheme(
     *      securityScheme="bearer",
     *      type="http",
     *      scheme="bearer"
     * )
     *
     */
}
