<?php

namespace App\Http\Resources;

use App\Models\Person;
use App\Models\PetType;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonWithPetsResource extends JsonResource
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
            'birthday' => $this->birthday,
            'token_id' => $this->token_id,
            'pets' => (Person::find($this->id)->pets)->each(function($pet){
                $pet->adopted = $pet->pivot->adopted;
                $pet->pet_type = PetType::find($pet->pet_type_id);
                unset($pet->pet_type_id);
            }),
            'crated_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
