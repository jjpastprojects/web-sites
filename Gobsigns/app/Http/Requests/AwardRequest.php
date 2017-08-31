<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Award;

class AwardRequest extends Request
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
            'award_type_id' => 'required',
            'user_id' => 'required',
            'cash' => 'numeric',
            'month' => 'required',
            'year' => 'required',
            'award_date' => 'required|date'
        ];
    }
}
