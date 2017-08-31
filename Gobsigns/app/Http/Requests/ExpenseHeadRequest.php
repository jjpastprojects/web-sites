<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\ExpenseHead;

class ExpenseHeadRequest extends Request
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
                    'expense_head' => 'required|unique:expense_heads,expense_head'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'expense_head' => 'required|unique:expense_heads,expense_head,'.$this->route('id')
                ];
            }
            default:break;
        }
    }
}
