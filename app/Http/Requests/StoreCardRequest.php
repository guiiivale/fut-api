<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreCardRequest extends FormRequest
{
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
        return [
            'match_id' => 'required|integer',
            'player_id' => 'required|integer',
            'yellow_cards' => 'integer',
            'red_cards' => 'integer',
        ];
    }

    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'Validation errors',

            'data'      => $validator->errors()

        ]));
    }



    public function messages()
    {
        return [

            'match_id.required' => 'Match id is required',
            'match_id.integer' => 'Match id must be an integer',
            'player_id.required' => 'Player id is required',
            'player_id.integer' => 'Player id must be an integer',
            'yellow_cards.integer' => 'Yellow cards must be an integer',
            'red_cards.integer' => 'Red cards must be an integer',

        ];
    }

}
