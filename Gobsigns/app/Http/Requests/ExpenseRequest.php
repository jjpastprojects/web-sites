<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Expense;

class ExpenseRequest extends Request
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
        $expense = $this->route('expense');
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
                    'expense_head_id' => 'required',
                    'amount' => 'required|numeric',
                    'expense_date' => 'required|date'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'expense_head_id' => 'required',
                    'amount' => 'required|numeric',
                    'expense_date' => 'required|date'
                ];
            }
            default:break;
        }
    }
}
