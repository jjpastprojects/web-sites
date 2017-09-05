<?php

namespace App\Http\Requests;

class CreateRaffleRequest extends Request
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
            'title' => 'required',
            "mechanics" => "required",
            "rules" => "required",
            'prize' => 'required',
            'deadline' => 'required|date',
            'image' => 'required|image|max:10000',
        ];
    }


}
