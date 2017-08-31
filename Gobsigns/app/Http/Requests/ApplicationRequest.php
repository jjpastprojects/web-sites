<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Job;
use Auth;
use App\Application;
use Config;

class ApplicationRequest extends Request
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
        if(!Auth::check())
        return [
            'job_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'resume' => 'required|mimes:'.Config::get('config.application_format')
        ];
        else
        return [
            'job_id' => 'required',
            'resume' => 'required|mimes:'.Config::get('config.application_format')
        ];
    }
}
