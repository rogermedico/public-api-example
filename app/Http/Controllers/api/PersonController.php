<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use App\Models\PetType;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a list of resources.
     *
     * @return \Illuminate\Http\JsonResponse | \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/person",
     *      operationId="getPersonList",
     *      tags={"People"},
     *      summary="Get list of people",
     *      description="Returns list of people",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PeopleResource")
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
        return (new PersonResource(Person::all()))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display a list of resources.
     *
     * @return \Illuminate\Http\JsonResponse | \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/person/all",
     *      operationId="getPeopleWithAllInformation",
     *      tags={"People"},
     *      summary="Get list of people with all information",
     *      description="Returns list of people with information of all of their relations",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PeopleWithPetsResource")
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
    public function getPeopleWithRelations (Request $request)
    {
        $people = Person::with('pets')->get();
        foreach ($people as $person)
        {
            foreach($person->pets as $pet)
            {
                $pet->pet_type = PetType::find($pet->pet_type_id);
                unset($pet->pet_type_id);
            }
        }
        return (new PersonResource($people))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Display a list of resources.
     *
     * @return \Illuminate\Http\JsonResponse | \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/person/all/{id}",
     *      operationId="getPersonWithAllInformation",
     *      tags={"People"},
     *      summary="Get person with all information",
     *      description="Returns person with information of all of their relations",
     *      @OA\Parameter(
     *          name="id",
     *          description="Person id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PersonWithPetsResource")
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
     *      security={
     *          {"bearer": {}}
     *      }
     * ),
     */
    public function getPersonWithRelations(Request $request, Person $person)
    {
        foreach($person->pets as $pet)
        {
            $pet->pet_type = PetType::find($pet->pet_type_id);
            unset($pet->pet_type_id);
        }

        return (new PersonResource($person))
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
     *      path="/person",
     *      operationId="storePerson",
     *      tags={"People"},
     *      summary="Store new person",
     *      description="Returns the person created data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePersonRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Person")
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
    public function store(StorePersonRequest $request)
    {
        $validated = $request->validated();
        $person = Person::create(array_merge(
            $validated,
            [
                'token_id' => $request->user()->currentAccessToken()->id
            ]
        ));
        $person = Person::find($person->id);
        return (new PersonResource($person))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  Person  $person
     * @return \Illuminate\Http\JsonResponse | \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/person/{id}",
     *      operationId="getPersonById",
     *      tags={"People"},
     *      summary="Get person information",
     *      description="Returns person data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Person id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PersonResource")
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
    public function show(Person $person)
    {
        return (new PersonResource($person))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Person $person
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     *
     * @OA\Put(
     *      path="/person/{id}",
     *      operationId="updatePerson",
     *      tags={"People"},
     *      summary="Update existing person",
     *      description="Returns updated person data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Person id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePersonRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Person")
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
     *                  property="birthday",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string",
     *                      example="The birthday is not a valid date."
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
    public function update(UpdatePersonRequest $request, Person $person)
    {
        if ($request->user()->currentAccessToken()->id !== $person->token_id)
        {
            return response()->json(['message' => 'Forbidden'],Response::HTTP_FORBIDDEN);
        }

        $person->update(($request->validated()));
        return (new PersonResource($person))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Person $person
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * * @OA\Delete(
     *      path="/person/{id}",
     *      operationId="deletePerson",
     *      tags={"People"},
     *      summary="Delete existing person",
     *      description="Deletes a person record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Person id",
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
    public function destroy(Request $request, Person $person)
    {
        if ($request->user()->currentAccessToken()->id !== $person->token_id)
        {
            return response()->json(['message' => 'Forbidden'],Response::HTTP_FORBIDDEN);
        }

        $person->delete();
        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
