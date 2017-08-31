<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Job;

class JobRequest extends Request
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
        $job = $this->route('job');
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
                    'job_title' => 'required|unique:jobs,job_title',
                    'location_id' => 'required',
                    'numbers' => 'required',
                    'job_description' => 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'job_title' => 'required|unique:jobs,job_title,'.$job->id,
                    'location_id' => 'required',
                    'numbers' => 'required',
                    'job_description' => 'required'
                ];
            }
            default:break;
        }
    }
}
