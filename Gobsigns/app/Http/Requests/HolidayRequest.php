<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Holiday;

class HolidayRequest extends Request
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
        $holiday = $this->route('holiday');
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
                    'date' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'date' => 'required|unique:holidays,date,'.$holiday->id
                ];
            }
            default:break;
        }
    }
}
