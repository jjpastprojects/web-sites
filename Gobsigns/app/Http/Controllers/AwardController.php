<?php
namespace App\Http\Controllers;
use DB;
use Config;
use Entrust;
use App\Award;
use App\AwardType;
use App\Classes\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\AwardRequest;
use Activity;
use Auth;

Class AwardController extends Controller{

	protected $form = 'award-form';

	public function index(Award $award){

		if(!Entrust::can('manage_award'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(Entrust::can('manage_all_award'))
			$awards = $award->get();
		else{

			$child_locations = Helper::childLocation(Auth::user()->location_id,1);
			$child_users = \App\User::whereIn('location_id',$child_locations)->lists('id')->all();

			$awards = $award->with('user')->whereHas('user', function($q) use ($child_users) {
                $q->whereIn('user_id',$child_users);
            })->get();
		}

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Award Name'),
        		trans('messages.Staff'),
        		trans('messages.Gift'),
        		trans('messages.Cash'),
        		trans('messages.Description'),
        		trans('messages.Month & Year'),
        		trans('messages.Award Date')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($awards as $award){
        	$award_name = $award->AwardType->award_name;

        	if(count($award->User)){
	        	$user_name = "<ol class='nl'>";
	        	foreach($award->User as $user){
	        		$location = $user->Location;
	        		$location_name = $location->location;
	        		$client = $location->Client;
	        		$client_name = $client->client_name;
				    $user_name .= "<li>$user->first_name $user->last_name ($location_name in $client_name)</li>";
				}
	        	$user_name .= "</ol>";
        	} else 
        	$user_name = "All";

        	$options = '<div class="btn-group btn-group-xs">';
        	if(Auth::user()->id == $award->user_id || Entrust::can('manage_all_award')){
        		$options .= '<a href="award/'.$award->id.'/edit" class="btn btn-default" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a>';
        		$options .= delete_form(['award.destroy',$award->id]);
        	}
        	$options .= '</div>';


			$cols = array(
				$options,
				$award_name,
				$user_name,
				$award->gift,
				$award->cash,
				$award->award_description,
				ucfirst($award->month)." ".$award->year,
				Helper::showDate($award->award_date)
				);	
			$id = $award->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
			
        }

        Helper::writeResult($col_data);
        $page_title = "Award List";

        $data = ['col_heads' => $col_heads, 'page_title' => $page_title];

		return view('award.index',$data);
	}

	public function show(){
	}

	public function create(){

		if(!Entrust::can('create_award'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);

        $query = DB::table('users');

        if(!Entrust::can('manage_all_award'))
        	$query->whereIn('users.location_id',$child_locations);

        $users = $query->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

        $award_types = AwardType::lists('award_name','id')->all();
        
		return view('award.create',compact('users','award_types'));
	}

	public function edit(Award $award){

		if(!Entrust::can('edit_award') || (Auth::user()->id != $award->user_id && !Entrust::can('manage_all_award')))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$selected_user = array();

		foreach($award->User as $user){
			$selected_user[] = $user->id;
		}

        $users = DB::table('users')
        	->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

        $award_types = AwardType::lists('award_name','id')->all();

		$custom_field_values = Helper::getCustomFieldValues($this->form,$award->id);
		$data = [
			'users' => $users,
			'award' => $award,
			'award_types' => $award_types,
			'selected_user' => $selected_user,
			'custom_field_values' => $custom_field_values
			];

		return view('award.edit',$data);
	}

	public function store(AwardRequest $request, Award $award){	

		if(!Entrust::can('create_award'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$users = $request->input('user_id');
		foreach($users as $user){
			$awards = Award::where('month','=',$request->input('month'))
				->where('year','=',$request->input('year'))
				->join('assigned_awards','assigned_awards.award_id','=','awards.id')
				->where('assigned_awards.user_id','=',$user)
				->count();
			if(!$awards)
			$user_insert[] = $user;	
		}

		$data = $request->all();
		$data['user_id'] = Auth::user()->id;
	    $award->fill($data);
		$award->save();
	    $award->user()->sync($user_insert);
		Helper::storeCustomField($this->form,$award->id, $data);
		$activity = 'Added an award';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.SAVED'));	
	}

	public function update(AwardRequest $request, Award $award){

		if(!Entrust::can('edit_award'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$users = $request->input('user_id');
		foreach($users as $user){
			$awards = Award::where('month','=',$request->input('month'))
				->where('year','=',$request->input('year'))
				->join('assigned_awards','assigned_awards.award_id','=','awards.id')
				->where('assigned_awards.user_id','=',$user)
				->where('awards.id','!=',$award->id)
				->count();
			if(!$awards)
			$user_insert[] = $user;	
		}

		$data = $request->all();
		$award->fill($data);
		$award->save();
	    $award->user()->sync($user_insert);
		Helper::updateCustomField($this->form,$award->id, $data);
		$activity = 'Updated an award';
		Activity::log($activity);
		return redirect('/award')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Award $award){
		if(!Entrust::can('delete_award'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		Helper::deleteCustomField($this->form, $award->id);
        
        $award->delete();
		$activity = 'Deleted an award';
		Activity::log($activity);

        return redirect('/award')->withSuccess(config('constants.DELETED'));
	}
}
?>