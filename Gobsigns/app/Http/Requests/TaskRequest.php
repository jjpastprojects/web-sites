<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Task;

class TaskRequest extends Request
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
        $task = $this->route('task');
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
                    'task_title' => 'required|unique:tasks',
                    'start_date' => 'required|date|before_equal:due_date',
                    'due_date' => 'required|date',
                    'task_description' => 'required',
                    'user_id' => 'required',
                    'hours' => 'numeric'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'task_title' => 'required|unique:tasks,task_title,'.$task->id.',id',
                    'start_date' => 'required|date|before_equal:due_date',
                    'due_date' => 'required|date',
                    'task_description' => 'required',
                    'user_id' => 'required',
                    'hours' => 'numeric'
                ];
            }
            default:break;
        }
    }
}
