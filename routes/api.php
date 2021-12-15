<?php

use App\Http\Controllers\api\PersonController;
use App\Http\Controllers\api\PetController;
use App\Http\Controllers\api\PetTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('person/all', [PersonController::class, 'getPeopleWithRelations'])->middleware('auth:sanctum');
Route::get('person/all/{person}', [PersonController::class, 'getPersonWithRelations'])->middleware('auth:sanctum');
Route::apiResource('person', PersonController::class)->middleware('auth:sanctum');

Route::get('pet/all', [PetController::class, 'getPetsWithRelations'])->middleware('auth:sanctum');
Route::get('pet/all/{pet}', [PetController::class, 'getPetWithRelations'])->middleware('auth:sanctum');
Route::apiResource('pet', PetController::class)->middleware('auth:sanctum');

Route::apiResource('pettype', PetTypeController::class, [
    'parameters' => [
        'pettype' => 'petType'
    ]
])->middleware('auth:sanctum');
