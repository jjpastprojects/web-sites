<?php

namespace App\Http\Requests;

class CreateMultipleQuestionRequest extends Request
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
        'description' => 'required',
        'answers' => 'required|array',
        'correct_answer' => 'required|in:1,2,3,4',
    ];
    }


}
