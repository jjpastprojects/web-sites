<?php
namespace App\Http\Controllers;
use App\Http\Requests\LeaveTypeRequest;
use App\LeaveType;
use App\Classes\Helper;
use Config;

Class LeaveTypeController extends Controller{

	public function index(){
	}

	public function show(){
	}

	public function create(){
	}

	public function edit(LeaveType $leave_type){
		return view('leave_type.edit',compact('leave_type'));
	}

	public function store(LeaveTypeRequest $request, LeaveType $leave_type){	

		$leave_type->create($request->all());

		return redirect('/configuration#leave')->withSuccess(config('constants.ADDED'));				
	}

	public function update(LeaveTypeRequest $request, LeaveType $leave_type){

		$leave_type->fill($request->all())->save();

		return redirect('/configuration#leave')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(LeaveType $leave_type){
        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        $leave_type->delete();
        return redirect('/configuration#leave')->withSuccess(config('constants.DELETED'));
	}
}
?>