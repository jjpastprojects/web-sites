<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\AwardTypeRequest;
use App\AwardType;
use App\Classes\Helper;
use Config;

Class AwardTypeController extends Controller{

	public function index(){
	}

	public function show(){
	}

	public function create(){
	}

	public function edit(AwardType $award_type){
		return view('award_type.edit',compact('award_type'));
	}

	public function store(AwardTypeRequest $request, AwardType $award_type){	

		$award_type->create($request->all());

		return redirect('/configuration#award')->withSuccess(config('constants.ADDED'));		
	}

	public function update(AwardTypeRequest $request, AwardType $award_type){

		$award_type->fill($request->all())->save();

		return redirect('/configuration#award')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(AwardType $award_type){
        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        $award_type->delete();
        return redirect()->back()->withSuccess(config('constants.DELETED'));
	}
}
?>