<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\AwardType;

class AwardTypeRequest extends Request
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'award_name' => 'required|unique:award_types,award_name'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'award_name' => 'required|unique:award_types,award_name,'.$this->route('id')
                ];
            }
            default:break;
        }
    }
}
