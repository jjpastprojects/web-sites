<?php
namespace App\Http\Controllers;
use App\User;
use App\BankAccount;
use Config;
use Entrust;
use Activity;
use Illuminate\Http\Request;
use App\Http\Requests\BankAccountRequest;

Class BankAccountController extends Controller{

	public function store(BankAccountRequest $request, BankAccount $bank_account){
		$id = $request->input('user_id');
        $employee = User::find($id);

        if(!$employee)
            return redirect('/employee')->withErrors(config('constants.INVALID_LINK'));

	    $bank_account->fill($request->all());
        $employee->bankAccount()->save($bank_account);

        return redirect('/employee/'.$id."#bank-account")->withSuccess(config('constants.SAVED'));			
	}

	public function destroy(BankAccount $bank_account){
		if(!Entrust::hasRole('admin'))
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));
		
		$id = $bank_account->User->id;

		$activity = 'Bank Account deleted';
		Activity::log($activity);
		$bank_account->delete();

		return redirect('/employee/'.$id."#bank-account")->withSuccess(config('constants.DELETED'));
	}
}
?>