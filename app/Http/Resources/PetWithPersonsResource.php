<?php

namespace App\Http\Resources;

use App\Models\Person;
use App\Models\Pet;
use App\Models\PetType;
use Illuminate\Http\Resources\Json\JsonResource;

class PetWithPersonsResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'pet_type_id' => PetType::find($this->pet_type_id),
            'token_id' => $this->token_id,
            'persons' => (Pet::find($this->id)->persons)->each(function($person){
                $person->adopted = $person->pivot->adopted;
            }),
            'crated_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
