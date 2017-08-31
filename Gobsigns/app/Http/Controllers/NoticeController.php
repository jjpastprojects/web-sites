<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\NoticeRequest;
use Entrust;
use Config;
use App\Notice;
use App\Classes\Helper;
use Auth;
use Activity;

Class NoticeController extends Controller{

	protected $form = 'notice-form';

	public function index(Notice $notice){

		if(!Entrust::can('manage_notice'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(Entrust::can('manage_all_notice'))
			$notices = $notice->get();
		else
			$notices = $notice->where('username','=',Auth::user()->username)->get();
        $token = csrf_token();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Title'),
        		trans('messages.Notice For'),
        		trans('messages.From Date'),
        		trans('messages.To Date')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($notices as $notice){

        	$location_name = "<ol class='nl'>";
        	foreach($notice->Location as $location){
        		$client = $location->Client;
			    $location_name .= "<li>$location->location ($client->client_name)</li>";
			}
        	$location_name .= "</ol>";

			$cols = array(
				'<a href="notice/'.$notice->id.'/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
				delete_form(['notice.destroy',$notice->id]),
				$notice->title,
				$location_name,
				Helper::showDate($notice->from_date),
				Helper::showDate($notice->to_date)
				);	
			$id = $notice->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
			
        }

        Helper::writeResult($col_data);

		return view('notice.index',compact('col_heads'));
	}

	public function show(){
	}

	public function create(){

		if(!Entrust::can('create_notice'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);
        $query = DB::table('locations');

        if(Entrust::can('manage_all_notice')){}
        elseif(Entrust::can('manage_subordinate_notice'))
        	$query->whereIn('locations.id',$child_locations);

        $locations = $query->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(location, " (", client_name, ")") AS full_location, locations.id AS location_id'))
            ->lists('full_location','location_id');

		return view('notice.create',compact('locations'));
	}

	public function edit(Notice $notice){

		if(!Entrust::can('edit_notice'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(!Entrust::can('manage_all_notice') && $notice->username != Auth::user()->username)
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
		$selected_location = array();

		foreach($notice->Location as $location){
			$selected_location[] = $location->id;
		}

        $locations = DB::table('locations')
            ->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(location, " (", client_name, ")") AS full_location, locations.id AS location_id'))
            ->lists('full_location','location_id');

		$custom_field_values = Helper::getCustomFieldValues($this->form,$notice->id);
		return view('notice.edit',compact('locations','notice','selected_location','custom_field_values'));
	}

	public function store(NoticeRequest $request, Notice $notice){

		if(!Entrust::can('create_notice'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$data = $request->all();
	    $notice->fill($data);
		$notice->username = Auth::user()->username;
		$notice->save();
	    $notice->location()->sync($request->input('location_id'));
		Helper::storeCustomField($this->form,$notice->id, $data);
		$activity = 'Publish a notice';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.SAVED'));		
	}

	public function update(NoticeRequest $request, Notice $notice){

		if(!Entrust::can('edit_notice'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(!Entrust::can('manage_all_notice') && $notice->username != Auth::user()->username)
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
		$data = $request->all();
		$notice->fill($data);
		$notice->save();
	    $notice->location()->sync($request->input('location_id'));
		Helper::updateCustomField($this->form,$notice->id, $data);
		$activity = 'Edit a notice';
		Activity::log($activity);
		return redirect('/notice')->withSuccess(config('constants.SAVED'));
	}

	public function destroy(Notice $notice){
		if(!Entrust::can('delete_notice'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(!Entrust::can('manage_all_notice') && $notice->username != Auth::user()->username)
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		Helper::deleteCustomField($this->form, $notice->id);
        $notice->delete();
		$activity = 'Deleted a Notice';
		Activity::log($activity);

        return redirect('/notice')->withSuccess(config('constants.DELETED'));
	}
}
?>