<?php

namespace Lembarek\ShareFiles\Requests;

class AddFileRequest extends Request
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
                'name' => '',
                'description' => '',
                'links' => 'url',
                'universities' => '',
                'filetype' => '',
                'year' => '',
                'semester' => '',
                'factulry' => '',
                'country' => '',
        ];
    }
}
