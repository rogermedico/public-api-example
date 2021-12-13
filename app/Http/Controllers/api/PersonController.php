<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Resources\PersonResource;
use App\Models\Person;
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
     *       ),
     *     )
     */
    public function index(Request $request)
    {
        return (new PersonResource(Person::all()))
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
     *      )
     * )
     */
    public function store(StorePersonRequest $request)
    {

        $validated = $request->validated();
        $person = Person::create($validated);
        $person = Person::find($person);
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
     *      )
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
     *      )
     * )
     */
    public function update(UpdatePersonRequest $request, Person $person)
    {
        $person->update(($request->validated()));

        return (new PersonResource($person))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Person $person
     * @return \Illuminate\Http\Response
     *
     * * @OA\Delete(
     *      path="/person/{id}",
     *      operationId="deletePerson",
     *      tags={"People"},
     *      summary="Delete existing person",
     *      description="Deletes a person record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
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
     *      )
     * )
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
