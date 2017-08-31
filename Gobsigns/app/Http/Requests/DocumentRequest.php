<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;
use Config;

class DocumentRequest extends Request
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
                'document_type_id' => 'required',
                'expiry_date' => 'date',
                'document_title' => 'required',
                'document_description' => 'required',
                'file' => 'required|mimes:'.Config::get('config.allowed_upload_file')
            ];
    }
}
