<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgrameRequest extends FormRequest
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
            "name"=>"required",
            "body"=>"required",
            "exercises"=>"required|array",
            "exercises.*.exerciseId" => "required|exists:exercises,id",
            "exercises.*.counters" => "required|integer",
            "exercises.*.day" => "required|integer",
            // "exercises"=>[
            //     "exerciseId"=>"required|exists:exercises,id",
            //     "counters"=>"required|integer",
            //     "day"=>"required|integer",
            // ],
            "usersId" => "required|array",
            "usersId.*" => "exists:customers,id",
        ];
    }
}
