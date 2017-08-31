<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\Http\Requests\LeaveStatusRequest;
use DB;
use Entrust;
use App\Leave;
use App\LeaveType;
use App\User;
use Config;
use Auth;
use Activity;
use App\Classes\Helper;

Class LeaveController extends Controller{

	protected $form = 'leave-form';

	public function index(Leave $leave){

		if(!Entrust::can('manage_leave'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(Entrust::can('manage_everyone_leave'))
        	$leaves = $leave->get();
        elseif(Entrust::can('manage_subordinate_leave')){
			$child_locations = Helper::childLocation(Auth::user()->location_id,1);
			$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
			array_push($child_users, Auth::user()->id);
    		$leaves = $leave->whereIn('user_id',$child_users)->get();
        }
    	else
    		$leaves = $leave->where('user_id','=',Auth::user()->id)->get();
        
        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Staff Name'),
        		trans('messages.Leave Type'),
        		trans('messages.From Date'),
        		trans('messages.To Date'),
        		trans('messages.Status')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($leaves as $leave){
        	$employee = $leave->User;
        	$name = $employee->first_name." ".$employee->last_name;
        	$leave_type = $leave->LeaveType;
        	$leave_type_name = $leave_type->leave_name;
        	$location = $employee->Location;
        	$client = $location->Client;

			$cols = array(
					'<div class="btn-group btn-group-xs">'.
					'<a href="/leave/'.$leave->id.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="View"> <i class="fa fa-share"></i></a> '.
					'<a href="/leave/'.$leave->id.'/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
					delete_form(['leave.destroy',$leave->id]).'</div>',
					$name." (".$location->location." in ".$client->client_name." )",
					$leave_type_name,
					Helper::showDate($leave->from_date),
					Helper::showDate($leave->to_date),
					ucfirst($leave->leave_status)
					);	
			$id = $leave->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);

		return view('leave.index',compact('col_heads'));
	}

	public function show(Leave $leave){

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);
		$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
		array_push($child_users, Auth::user()->id);

      	if(!Entrust::can('view_leave') || (!Entrust::can('manage_everyone_leave') && Entrust::can('manage_subordinate_leave') && !in_array($leave->user_id, $child_users) ))
          	return redirect('/dashboard')->withErrors(config('constants.NA'));

		$employee = $leave->User;
		$location = $employee->Location;
    	$client = $location->Vlient;

    	$other_leaves = Leave::where('id','!=',$leave->id)
    		->where('user_id','=',$leave->user_id)
    		->get();

        $data = [
        	'leave' => $leave,
        	'employee' => $employee,
        	'location' => $location,
        	'client' => $client,
        	'other_leaves' => $other_leaves
        	];

		return view('leave.show',$data);
	}

	public function create(){

		if(!Entrust::can('create_leave'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $query = DB::table('users');

        if(!Entrust::hasRole('admin'))
        	$query->where('users.id','=',Auth::user()->id);

        $users= $query->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');
        $leave_types = LeaveType::lists('leave_name','id')->all();
        
		return view('leave.create',compact('users','leave_types'));
	}

	public function edit(Leave $leave){

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);
		$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
		array_push($child_users, Auth::user()->id);

      	if(!Entrust::can('edit_leave') || (!Entrust::can('manage_everyone_leave') && Entrust::can('manage_subordinate_leave') && !in_array($leave->user_id, $child_users) ))
          	return redirect('/dashboard')->withErrors(config('constants.NA'));

		if($leave->leave_status != 'pending' && $leave->user_id == Auth::user()->id)
			return redirect('leave')->withErrors('This leave cannot be edited. It is either approved or rejected. ');
		
        $query = DB::table('users');

        if(Entrust::can('manage_everyone_leave')){}
        elseif(Entrust::can('manage_subordinate_leave')){
        	$query->whereIn('users.id',$child_users);
        } else {
        	$query->where('users.id','=',Auth::user()->id);
        }

        $users= $query->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

        $leave_types = LeaveType::lists('leave_name','id')->all();
        $custom_field_values = Helper::getCustomFieldValues($this->form,$leave->id);
		
		return view('leave.edit',[
				'leave' => $leave,
				'users' => $users,
				'leave_types' => $leave_types,
				'custom_field_values' => $custom_field_values
				]);
	}

	public function store(LeaveRequest $request, Leave $leave){	
		if(!Entrust::can('create_leave'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$user_id = $request->input('user_id');
		$from_date = $request->input('from_date');
		$to_date = $request->input('to_date');

		$leaves = Leave::where('user_id','=',$user_id)
			->where(function ($query) use($from_date,$to_date) { $query->where(function ($query) use($from_date,$to_date){
				$query->where('from_date','>=',$from_date)
				->where('from_date','<=',$to_date);
			})->orWhere(function ($query)  use($from_date,$to_date) {
				$query->where('to_date','>=',$from_date)
					->where('to_date','<=',$to_date);
			});})->count();

		if($leaves)
			return redirect()->back()->withInput()->withErrors('Leave already requested for some of this duration.');

		$data = $request->all();
	    $leave->fill($data);
	    $leave->leave_status = 'pending';
		$leave->save();

		Helper::storeCustomField($this->form,$leave->id, $data);

		$activity = 'Requested for a leave';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function update(LeaveRequest $request, Leave $leave){

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);
		$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
		array_push($child_users, Auth::user()->id);

      	if(!Entrust::can('edit_leave') || (!Entrust::can('manage_everyone_leave') && Entrust::can('manage_subordinate_leave') && !in_array($leave->user_id, $child_users) ))
          	return redirect('/dashboard')->withErrors(config('constants.NA'));

		if($leave->leave_status != 'pending' && $leave->user_id == Auth::user()->id)
			return redirect('leave')->withErrors('This leave cannot be edited. It is either approved or rejected. ');
		
		$user_id = $request->input('user_id');
		$from_date = $request->input('from_date');
		$to_date = $request->input('to_date');

		$leaves = Leave::where('id','!=',$leave->id)
			->where('user_id','=',$user_id)
			->where(function ($query) use($from_date,$to_date) { $query->where(function ($query) use($from_date,$to_date)  {
				$query->where('from_date','>=',$from_date)
				->where('from_date','<=',$to_date);
			})->orWhere(function ($query) use($from_date,$to_date)  {
				$query->where('to_date','>=',$from_date)
					->where('to_date','<=',$to_date);
			});})->count();

		if($leaves)
			return redirect()->back()->withErrors('Leave already requested for some of this duration.');
		
		$data = $request->all();
		$leave->fill($data);
		$leave->save();
		Helper::updateCustomField($this->form,$leave->id, $data);

		$activity = 'Updated a leave request';
		Activity::log($activity);
		return redirect('/leave')->withSuccess(config('constants.UPDATED'));
	}

	public function updateStatus(LeaveStatusRequest $request){

		$id = $request->input('id');
		$leave = Leave::find($id);

		if(!$leave)
			return redirect('/leave')->withErrors(config('constants.INVALID_LINK'));

		if(!Entrust::can('edit_leave_status') || $leave->user_id == Auth::user()->id)
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$leave->leave_status = $request->input('leave_status');
		$leave->leave_comment = $request->input('leave_comment');
		$leave->save();

		return redirect()->back()->withSuccess('Leave status updated successfully. ');
	}

	public function destroy(Leave $leave){
		if(!Entrust::can('delete_leave'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		Helper::deleteCustomField($this->form, $leave->id);
        $leave->delete();
		$activity = 'Deleted a Leave';
		Activity::log($activity);

        return redirect('/leave')->withSuccess(config('constants.DELETED'));
	}
}
?>