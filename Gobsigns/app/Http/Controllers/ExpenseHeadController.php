<?php
namespace App\Http\Controllers;
use App\Http\Requests\ExpenseHeadRequest;
use App\ExpenseHead;
use App\Classes\Helper;
use Config;

Class ExpenseHeadController extends Controller{

	public function index(){
	}

	public function show(){
	}

	public function create(){
	}

	public function edit(ExpenseHead $expense_head){
		return view('expense_head.edit',compact('expense_head'));
	}

	public function store(ExpenseHeadRequest $request, ExpenseHead $expense_head){	

		$expense_head->create($request->all());

		return redirect('/configuration#expense')->withSuccess(config('constants.ADDED'));				
	}

	public function update(ExpenseHeadRequest $request, ExpenseHead $expense_head){

		$expense_head->fill($request->all())->save();

		return redirect('/configuration#expense')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(ExpenseHead $expense_head){
        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        $expense_head->delete();
        return redirect('/configuration#expense')->withSuccess(config('constants.DELETED'));
	}
}
?>