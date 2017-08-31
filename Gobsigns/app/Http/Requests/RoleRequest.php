<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Role;

class RoleRequest extends Request
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
                    'name' => 'required|unique:roles,name',
                    'display_name' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'display_name' => 'required'
                ];
            }
            default:break;
        }
    }
}
