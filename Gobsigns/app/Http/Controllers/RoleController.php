<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Role;
use App\Classes\Helper;
use Config;

Class RoleController extends Controller{

	public function index(){
	}

	public function show(){
	}

	public function create(){
	}

	public function edit(Role $role){
		return view('role.edit',compact('role'));
	}

	public function store(RoleRequest $request){	

		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		$role = new Role;
		$data = $request->all();
	    $role->fill($data);
		$role->save();

		return redirect('/configuration#permission')->withSuccess(config('constants.ADDED'));		
	}

	public function update(RoleRequest $request, Role $role){
		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		$role->display_name = $request->input('display_name');
		$role->save();
		return redirect('/configuration#permission')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Role $role){

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        if($role->name == 'admin')
            return redirect('/configuration#permission')->withErrors(config('constants.INVALID_LINK'));

        $role->delete();
        return redirect()->back()->withSuccess(config('constants.DELETED'));
	}
}
?>