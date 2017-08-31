<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Notice;

class NoticeRequest extends Request
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
        $notice = $this->route('notice');
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
                    'title' => 'required|unique:notice',
                    'from_date' => 'required|date|before_equal:to_date',
                    'to_date' => 'required|date',
                    'content' => 'required',
                    'location_id' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => 'required|unique:notice,title,'.$notice->id.',id',
                    'from_date' => 'required|date|before_equal:to_date',
                    'to_date' => 'required|date',
                    'content' => 'required',
                    'location_id' => 'required'
                ];
            }
            default:break;
        }
    }
}
