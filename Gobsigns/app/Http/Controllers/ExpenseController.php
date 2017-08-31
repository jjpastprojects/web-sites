<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ExpenseRequest;
use Entrust;
use App\Classes\Helper;
use App\Expense;
use App\ExpenseHead;
use Activity;
use Config;
use Auth;

Class ExpenseController extends Controller{

	protected $form = 'expense-form';
	
	public function index(){

		if(!Entrust::can('manage_expense'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $expenses = Expense::all();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Expense Head'),
        		trans('messages.Amount'),
        		trans('messages.Date'),
        		trans('messages.Remarks')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($expenses as $expense){

			$cols = array(
					'<div class="btn-group btn-group-xs">'.
					'<a href="/expense/'.$expense->id.'/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
					delete_form(['expense.destroy',$expense->id]).
					'</div>',
					$expense->ExpenseHead->expense_head,
					$expense->amount,
					Helper::showDate($expense->expense_date),
					$expense->remarks
					);	
			$id = $expense->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);

        $data = ['col_heads' => $col_heads];

		return view('expense.index',$data);
	}

	public function show(){
	}

	public function create(){

		if(!Entrust::can('create_expense'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$expense_heads = ExpenseHead::lists('expense_head','id')->all();

		return view('expense.create',compact('expense_heads'));
	}

	public function edit(Expense $expense){

		if(!Entrust::can('edit_expense'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$expense_heads = ExpenseHead::lists('expense_head','id')->all();

		$custom_field_values = Helper::getCustomFieldValues($this->form,$expense->id);
		return view('expense.edit',compact('expense','expense_heads'));
	}

	public function store(ExpenseRequest $request, Expense $expense){	
		if(!Entrust::can('create_expense'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$expense = new Expense;
		$data = $request->all();
	    $expense->fill($data);
		$expense->user_id = Auth::user()->id;
		$expense->save();
		Helper::storeCustomField($this->form,$expense->id, $data);

		$activity = 'New Expense added';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function update(ExpenseRequest $request, Expense $expense){

		if(!Entrust::can('edit_expense'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$data = $request->all();
		$expense->fill($data)->save();
		Helper::updateCustomField($this->form,$expense->id, $data);
		$activity = 'Expense updated';
		Activity::log($activity);
		return redirect('/expense')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Expense $expense){
		if(!Entrust::can('delete_expense'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		Helper::deleteCustomField($this->form, $expense->id);
        $expense->delete();
        return redirect('/expense')->withSuccess(config('constants.DELETED'));
	}
}
?>