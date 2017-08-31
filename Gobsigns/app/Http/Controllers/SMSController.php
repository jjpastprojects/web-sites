<?php
namespace App\Http\Controllers;
use DB;
use Entrust;
use Config;
use Illuminate\Http\Request;
use Validator;
use App\Classes\Helper;

Class SMSController extends Controller{

	public function index($type = 'location'){

		if(!Entrust::can('manage_sms'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if($type == 'location')
        $receivers = DB::table('locations')
            ->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(location, " (", client_name, ")") AS full_location,locations.id AS location_id'))
            ->lists('full_location','location_id');
       	else
        $receivers = DB::table('users')
        	->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

        $type_detail = ($type == 'location') ? 'Location' : 'Individual Staff' ;

		$data = [
			'type' => $type,
			'receivers' => $receivers,
			'type_detail' => $type_detail
			];
		return view('sms.index',$data);
	}

	public function sendEmployeeSMS(Request $request, $id){
		$user = \App\User::find($id);

		$validation = Validator::make($request->all(),[
				'sms' => 'required'
				]);

		if($validation->fails()){
			return redirect()->back()->withInput()->withErrors($validation->messages());
		}

      	$response = Helper::sendSMS($user->Profile->contact_number,$request->input('sms'));

      	if($response == 1)
      		return redirect()->back()->withSuccess('SMS Sent successfully. ');
      	else
      		return redirect()->back()->withErrors($response);
	}

	public function store()
	{
		return redirect()->back();
	}
}
?>