<?php
namespace App\Http\Controllers;
use App\Http\Requests\SalaryTypeRequest;
use App\SalaryType;
use App\Classes\Helper;
use Config;

Class SalaryTypeController extends Controller{

	public function index(){
	}

	public function show(){
	}

	public function create(){
	}

	public function edit(SalaryType $salary_type){
		return view('salary_type.edit',compact('salary_type'));
	}

	public function store(SalaryTypeRequest $request, SalaryType $salary_type){	

		$salary_type->create($request->all());

		return redirect('/configuration#salary')->withSuccess(config('constants.ADDED'));				
	}

	public function update(SalaryTypeRequest $request, SalaryType $salary_type){

		$salary_type->fill($request->all())->save();

		return redirect('/configuration#salary')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(SalaryType $salary_type){
        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        $salary_type->delete();
        return redirect('/configuration#salary')->withSuccess(config('constants.DELETED'));
	}
}
?>