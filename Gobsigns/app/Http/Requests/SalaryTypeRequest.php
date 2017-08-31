<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\SalaryType;

class SalaryTypeRequest extends Request
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
                    'salary_type' => 'required|in:earning,deduction',
                    'salary_head' => 'required|unique:salary_types,salary_head'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'salary_type' => 'required|in:earning,deduction',
                    'salary_head' => 'required|unique:salary_types,salary_head,'.$this->route('id')
                ];
            }
            default:break;
        }
    }
}
