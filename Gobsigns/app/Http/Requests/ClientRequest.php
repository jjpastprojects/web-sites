<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Client;

class ClientRequest extends Request
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
        $client = $this->route('client');
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                $rules = [
                    'client_name' => 'required|unique:clients,client_name'
                ];
                return $rules;
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'client_name' => 'required|unique:clients,client_name,'.$client->id
                ];
            }
            default:break;
        }
    }
}
