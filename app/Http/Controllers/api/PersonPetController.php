<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonPetRequest;
use App\Http\Resources\PersonPetResource;
use App\Models\PersonPet;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonPetController extends Controller
{
    /**
     * Display a list of resources.
     *
     * @return \Illuminate\Http\JsonResponse | \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/pet",
     *      operationId="getPetList",
     *      tags={"Pets"},
     *      summary="Get list of pets",
     *      description="Returns list of pets",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PetsResource")
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
        return (new PersonPetResource(PersonPet::all()))
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
     *      path="/pet",
     *      operationId="storePet",
     *      tags={"Pets"},
     *      summary="Store new pet",
     *      description="Returns the pet created data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePetRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Pet")
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
     *                      example="The name field is required."
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
    public function store(StorePersonPetRequest $request)
    {
        $validated = $request->validated();
        $personPet = PersonPet::create(array_merge(
            $validated,
            [
                'token_id' => $request->user()->currentAccessToken()->id
            ]
        ));
        $personPet = PersonPet::where('person_id',$personPet->person_id)->where('pet_id',$personPet->pet_id)->get();
        return (new PersonPetResource($personPet))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  Pet $pet
     * @return \Illuminate\Http\JsonResponse | \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/pet/{id}",
     *      operationId="getPetById",
     *      tags={"Pets"},
     *      summary="Get pet information",
     *      description="Returns pet data",
     *      @OA\Parameter(
     *          name="id",
     *          description="pet id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PetResource")
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
    public function show(Pet $pet)
    {
        return (new PetResource($pet))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Pet $pet
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     *
     * @OA\Put(
     *      path="/pet/{id}",
     *      operationId="updatePet",
     *      tags={"Pets"},
     *      summary="Update existing pet",
     *      description="Returns updated pet data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Pet id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePetRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Pet")
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
     *              ),
     *              @OA\Property(
     *                  property="pet_type_id",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The selected pet type id is invalid."
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
    public function update(UpdatePetRequest $request, Pet $pet)
    {
        if ($request->user()->currentAccessToken()->id !== $pet->token_id)
        {
            return response()->json(['message' => 'Forbidden'],Response::HTTP_FORBIDDEN);
        }

        $pet->update(($request->validated()));
        return (new PetResource($pet))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Pet $pet
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * * @OA\Delete(
     *      path="/pet/{id}",
     *      operationId="deletePet",
     *      tags={"Pets"},
     *      summary="Delete existing pet",
     *      description="Deletes a pet record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Pet id",
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
    public function destroy(Request $request, Pet $pet)
    {
        if ($request->user()->currentAccessToken()->id !== $pet->token_id)
        {
            return response()->json(['message' => 'Forbidden'],Response::HTTP_FORBIDDEN);
        }

        $pet->delete();
        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
