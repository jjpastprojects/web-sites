<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Entrust;
use App\Classes\Helper;
use App\Client;
use Activity;
use Config;
use DB;

Class ClientController extends Controller{

	protected $form = 'client-form';

	public function index(Client $client){

		if(!Entrust::can('manage_client'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $clients = $client->get();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Client Name'),
        		trans('messages.Description'),
        		trans('messages.Location')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($clients as $client){
        	$des = $client->Location;

        	$location_name = "<ol>";
        	foreach($des as $location)
        		$location_name .= "<li>$location->location</li>";
        	$location_name .= "</ol>";

			$linkToEdit = "";
			$cols = array(
				'<div class="btn-group btn-group-xs">'.
				'<a href="/client/'.$client->id.'/edit" class="btn btn-xs btn-default" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
				delete_form(['client.destroy',$client->id]).
				'</div>',
				$client->client_name,
				$client->client_description,
				$location_name
				);
			$id = $client->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);

        $data = ['col_heads' => $col_heads];

		return view('client.index',$data);
	}

	public function show(){
	}

	public function create(){

		if(!Entrust::can('create_client'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		return view('client.create');
	}

	public function edit(Client $client){

		if(!Entrust::can('edit_client'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$custom_field_values = Helper::getCustomFieldValues($this->form,$client->id);
		return view('client.edit',compact('client','custom_field_values'));
	}

	public function store(ClientRequest $request, Client $client){	

		if(!Entrust::can('create_client'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$data = $request->all();
		$client->fill($data)->save();

		Helper::storeCustomField($this->form,$client->id, $data);

		$activity = 'New client "'.$request->input('client_name').'" added';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function update(ClientRequest $request, Client $client){

		if(!Entrust::can('edit_client'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$data = $request->all();
		$client->fill($data)->save();

		Helper::updateCustomField($this->form,$client->id, $data);

		$activity = 'Client "'.$request->input('client_name').'" updated';
		Activity::log($activity);
		
		return redirect('/client')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Client $client){
		if(!Entrust::can('delete_client'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		Helper::deleteCustomField($this->form, $client->id);
        
        $client->delete();

		$activity = 'Deleted a Client';
		Activity::log($activity);

        return redirect('/client')->withSuccess(config('constants.DELETED'));
	}
}
?>