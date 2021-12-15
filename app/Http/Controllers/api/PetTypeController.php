<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePetTypeRequest;
use App\Http\Requests\UpdatePetTypeRequest;
use App\Http\Resources\PetTypeResource;
use App\Models\PetType;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PetTypeController extends Controller
{
    /**
     * Display a list of resources.
     *
     * @return \Illuminate\Http\JsonResponse | \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/pettype",
     *      operationId="getPetTypeList",
     *      tags={"Pet Types"},
     *      summary="Get list of pet types",
     *      description="Returns list of pet types",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PetTypesResource")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Unauthenticated"
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearer": {}}
     *      }
     * ),
     */
    public function index(Request $request)
    {
        return (new PetTypeResource(PetType::all()))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     *
     * @OA\Post(
     *      path="/pettype",
     *      operationId="storePetType",
     *      tags={"Pet Types"},
     *      summary="Store new pet type",
     *      description="Returns the pet type created data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePetTypeRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PetType")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable entity",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="name",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The name has already been taken."
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Unauthenticated"
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearer": {}}
     *      }
     * )
     */
    public function store(StorePetTypeRequest $request)
    {
        $validated = $request->validated();
        $pet = PetType::create(array_merge(
            $validated,
            [
                'token_id' => $request->user()->currentAccessToken()->id
            ]
        ));
        $pet = PetType::find($pet->id);
        return (new PetTypeResource($pet))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  PetType $petType
     * @return \Illuminate\Http\JsonResponse | \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/pettype/{id}",
     *      operationId="getPetTypeById",
     *      tags={"Pet Types"},
     *      summary="Get pet type information",
     *      description="Returns pet type data",
     *      @OA\Parameter(
     *          name="id",
     *          description="pet type id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PetTypeResource")
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Resource Not Found",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Object not found"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Unauthenticated"
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearer": {}}
     *      }
     * )
     *
     */
    public function show(PetType $petType)
    {
        return (new PetTypeResource($petType))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PetType $petType
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     *
     * @OA\Put(
     *      path="/pettype/{id}",
     *      operationId="updatePetType",
     *      tags={"Pet Types"},
     *      summary="Update existing pet type",
     *      description="Returns updated pet type data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Pet type id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePetTypeRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PetType")
     *       ),
     *       @OA\Response(
     *          response=422,
     *          description="Unprocessable entity",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="name",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The name must not be greater than 255 characters."
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Object not found"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Unauthenticated"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Forbidden"
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearer": {}}
     *      }
     * )
     */
    public function update(UpdatePetTypeRequest $request, PetType $petType)
    {
        if ($request->user()->currentAccessToken()->id !== $petType->token_id)
        {
            return response()->json(['message' => 'Forbidden'],Response::HTTP_FORBIDDEN);
        }

        $petType->update(($request->validated()));
        return (new PetTypeResource($petType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PetType $petType
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * * @OA\Delete(
     *      path="/pettype/{id}",
     *      operationId="deletePetType",
     *      tags={"Pet Types"},
     *      summary="Delete existing pet type",
     *      description="Deletes a pet type record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Pet type id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Object not found"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Unauthenticated"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Forbidden"
     *              )
     *          )
     *      ),
     *      security={
     *          {"bearer": {}}
     *      }
     * )
     */
    public function destroy(Request $request, PetType $petType)
    {
        if ($request->user()->currentAccessToken()->id !== $petType->token_id)
        {
            return response()->json(['message' => 'Forbidden'],Response::HTTP_FORBIDDEN);
        }

        $petType->delete();
        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
