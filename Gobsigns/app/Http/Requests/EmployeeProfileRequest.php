<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;
use App\User;

class EmployeeProfileRequest extends Request
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
        $id = $this->route('id');
        $employee = User::find($id);
        return [
                'photo' => 'image|image_size:<=2000|max:100000',
                'date_of_birth' => 'date',
                'date_of_joining' => 'date',
                'date_of_leaving' => 'date',
                'employee_code' => 'required|unique:profile,employee_code,'.$employee->Profile->id.',id'
            ];
    }
}
