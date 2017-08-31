<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\CustomField;

class CustomFieldRequest extends Request
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
            'form' => 'required',
            'field_title' => 'required|unique_with:custom_fields,form',
            'field_type' => 'required',
        ];
    }
}
