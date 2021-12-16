<?php

namespace App\Http\Requests;

use App\Models\PersonPet;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UpdatePersonPetRequest extends FormRequest
{

    protected $validator;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $personPet = $this->route('personPet');

        return [
            'id' => '',
            'person_id' => [
                'integer',
                'exists:people,id',
                Rule::unique('person_pet','person_id')
                    ->where('pet_id',$this->pet_id ?? $personPet->pet_id)
                    ->ignore($personPet->id,'id')
                ],
            'pet_id' => [
                'integer',
                'exists:pets,id',
                Rule::unique('person_pet','pet_id')
                    ->where('person_id',$this->person_id ?? $personPet->person_id)
                    ->ignore($personPet->id,'id')
                ],
            'adopted' => 'date'
        ];
    }

    public function messages()
    {
        return [
            'person_id.unique' => 'The combination of person_id and pet_id already exists.',
            'pet_id.unique' => 'The combination of person_id and pet_id already exists.'
        ];
    }

    /**
     * Return validation errors in json format. Also avoid redirection feature.
     *
     * @return HttpResponseException
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }

}
