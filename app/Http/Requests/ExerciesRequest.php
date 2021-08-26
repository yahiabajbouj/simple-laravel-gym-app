<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExerciesRequest extends FormRequest
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
        $rule = [];
        $rule['name'] = "required";
        $rule['exercisesTypeId'] = "required|exists:exercises_types,id";
        if(request()->isMethod('post')){
            $rule["imgs"] = "required|array";
            $rule["imgs.*"] = "required|image";
        }else{
            $rule["imgs"] = "sometime|array";
            $rule["imgs.*"] = "sometime|image";
        }

        return $rule;
    }
}
