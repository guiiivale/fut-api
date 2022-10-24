<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreMatchRequest extends FormRequest
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
            'date' => 'required|date',
            'team1_id' => 'required|integer',
            'team2_id' => 'required|integer',
            'team1_score' => 'required|integer',
            'team2_score' => 'required|integer',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
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

            "date.required" => "Date is required",
            "team1_id.required" => "Team 1 is required",
            "team2_id.required" => "Team 2 is required",
            "team1_score.required" => "Team 1 score is required",
            "team2_score.required" => "Team 2 score is required",
            "start_time.required" => "Start time is required",
            "end_time.required" => "End time is required",

        ];
    }
}
