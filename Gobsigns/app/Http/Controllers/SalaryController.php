<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\SalaryType;
use App\Salary;
use Config;

Class SalaryController extends Controller{

	public function store(Request $request){
		$salary_types = SalaryType::all();

		foreach($salary_types as $salary_type){
			$salary = Salary::firstOrCreate(array('user_id' => $request->input('user_id'), 'salary_type_id' => $salary_type->id));
			$salary->user_id = $request->input('user_id');
			$salary->salary_type_id = $salary_type->id;
			$salary->amount = $request->input($salary_type->id);
			$salary->save();
		}

		return redirect('/employee/'.$request->input('user_id').'/#salary')->withSuccess(config('constants.UPDATED'));
	}
}
?>