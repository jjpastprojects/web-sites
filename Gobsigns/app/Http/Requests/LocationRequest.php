<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LocationRequest extends Request
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
        $location = $this->route('location');
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
                    'location' => 'required|unique_with:locations,client_id',
                    'client_id' => 'required',
                    'job_number' => 'required|unique:locations',
                    'store' => 'required',
                    'address1' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'zip' => 'required',
                    'phone' => 'required'/*,
                    'fax' => 'required'*/
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'client_id' => 'required',
                    'location' => 'required|unique_with:locations,client_id,'.$location->id,
                    'job_number' => 'required|unique_with:locations,job_number,'.$location->id,
                    'store' => 'required',
                    'address1' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'zip' => 'required',
                    'phone' => 'required'/*,
                    'fax' => 'required'*/
                    
                ];
            }
            default:break;
        }
    }
}
