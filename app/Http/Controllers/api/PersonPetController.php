<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonPetRequest;
use App\Http\Requests\UpdatePersonPetRequest;
use App\Http\Resources\PersonPetResource;
use App\Models\PersonPet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PersonPetController extends Controller
{
    /**
     * Display a list of resources.
     *
     * @return \Illuminate\Http\JsonResponse | \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/personpet",
     *      operationId="getPersonPetList",
     *      tags={"Person Pets"},
     *      summary="Get list of the relations between people and pets",
     *      description="Returns list of people and pets relations",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PersonPetsResource")
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
     *      path="/personpet",
     *      operationId="storePersonPet",
     *      tags={"Person Pets"},
     *      summary="Store new person pet",
     *      description="Store new relation between a person and a pet",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePersonPetRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PersonPet")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable entity",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="person_id",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The selected person id is invalid."
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PersonPet $personPet
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     *
     * @OA\Put(
     *      path="/personpet/{id}",
     *      operationId="updatePersonPet",
     *      tags={"Person Pets"},
     *      summary="Update existing relation between person and pet",
     *      description="Returns updated person pet data",
     *      @OA\Parameter(
     *          name="id",
     *          description="personPet id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePersonPetRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PersonPet")
     *       ),
     *       @OA\Response(
     *          response=422,
     *          description="Unprocessable entity",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="person_id",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The combination of person_id and pet_id already exists."
     *                  )
     *              ),
     *              @OA\Property(
     *                  property="adopted",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The adopted is not a valid date."
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
    public function update(UpdatePersonPetRequest $request, PersonPet $personPet)
    {
        Gate::authorize('update', $personPet);

        $personPet->update(($request->validated()));
        return (new PersonPetResource($personPet))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PersonPet $personPet
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * * @OA\Delete(
     *      path="/personpet/{id}",
     *      operationId="deletePersonPet",
     *      tags={"Person Pets"},
     *      summary="Delete existing person pet relation",
     *      description="Deletes a person pet record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="PersonPet id",
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
    public function destroy(Request $request, PersonPet $personPet)
    {
        Gate::authorize('destroy', $personPet);

        $personPet->delete();
        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
