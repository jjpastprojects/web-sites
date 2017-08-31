<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LeaveTypeRequest extends Request
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
                    'leave_name' => 'required|unique:leave_types,leave_name'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'leave_name' => 'required|unique:leave_types,leave_name,'.$this->route('id')
                ];
            }
            default:break;
        }
    }
}
