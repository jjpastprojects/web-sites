<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DocumentTypeRequest extends Request
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
                    'document_type_name' => 'required|unique:document_types,document_type_name'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'document_type_name' => 'required|unique:document_types,document_type_name,'.$this->route('id')
                ];
            }
            default:break;
        }
    }
}
