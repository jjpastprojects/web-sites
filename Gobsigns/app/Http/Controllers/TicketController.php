<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use DB;
use Entrust;
use Config;
use App\Ticket;
use App\User;
use Auth;
use Activity;
use App\Classes\Helper;

Class TicketController extends Controller{

	protected $form = 'ticket-form';

	public function index(Ticket $ticket){

		if(!Entrust::can('manage_ticket'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

    	if(Entrust::can('manage_everyone_ticket'))
    		$tickets = $ticket->get();
    	elseif(Entrust::can('manage_subordinate_ticket')){
			$child_locations = Helper::childLocation(Auth::user()->location_id,1);
			$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
			array_push($child_users, Auth::user()->id);
			$tickets = $ticket->whereIn('user_id',$child_users)->get();
    	} else
    		$tickets = $ticket->where('user_id','=',Auth::user()->id)->get();
    	
        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Name'),
        		trans('messages.Subject'),
        		trans('messages.Priority'),
        		trans('messages.Status'),
        		trans('messages.Date')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($tickets as $ticket){
        	$user = $ticket->User;
        	$name = $user->first_name." ".$user->last_name;

			$cols = array(
					'<div class="btn-group btn-group-xs">'.
					'<a href="/ticket/'.$ticket->id.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="View"> <i class="fa fa-share"></i></a> '.
					'<a href="/ticket/'.$ticket->id.'/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
					delete_form(['ticket.destroy',$ticket->id]).'</div>',
					$name,
					$ticket->ticket_subject,
					$ticket->ticket_priority,
					$ticket->ticket_status,
					Helper::showDateTime($ticket->created_at)
					);	
			$id = $ticket->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);

		return view('ticket.index',compact('col_heads'));
	}


	public function updateTicketStatus(Request $request){

		if(!Entrust::can('update_status_ticket'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$id = $request->input('ticket_id');
		$ticket_status = $request->input('ticket_status');
		
		$ticket = Ticket::find($id);

		if(!$ticket)
			return redirect('/ticket')->withErrors(config('constants.INVALID_LINK'));

		$ticket->id = $id;
		$ticket->ticket_status = $ticket_status;
		$ticket->save();
		$activity = 'Updated a ticket status';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.SAVED'));
	}

	public function show(Ticket $ticket){

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);
		$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
		array_push($child_users, Auth::user()->id);

      	if(!Entrust::can('view_ticket') || (!Entrust::can('manage_everyone_ticket') && Entrust::can('manage_subordinate_ticket') && !in_array($ticket->user_id, $child_users) ))
          	return redirect('/dashboard')->withErrors(config('constants.NA'));

		$note = DB::table('ticket_notes')
			->where('ticket_id','=',$ticket->id)
			->where('note_username','=',Auth::user()->username)
			->join('tickets','tickets.id','=','ticket_notes.ticket_id')
			->first();

		$comments = DB::table('ticket_comments')
			->where('ticket_id','=',$ticket->id)
			->join('tickets','tickets.id','=','ticket_comments.ticket_id')
			->join('users','users.username','=','ticket_comments.comment_username')
			->select(DB::raw('users.username,ticket_comments.id,users.id as user_id,comment,ticket_comments.created_at,first_name,last_name'))
			->get();

		$attachments = DB::table('ticket_attachments')
			->where('ticket_id','=',$ticket->id)
			->join('tickets','tickets.id','=','ticket_attachments.ticket_id')
			->select(DB::raw('attachment_username,ticket_attachments.id,attachment_title,attachment_description,ticket_attachments.created_at,file'))
			->get();

		$data = [
			'ticket' => $ticket,
			'note' => $note,
			'comments' => $comments,
			'attachments' => $attachments
			];

		return view('ticket.show',$data);
	}

	public function create(){

		if(!Entrust::can('create_ticket'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		return view('ticket.create');
	}

	public function edit(Ticket $ticket){

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);
		$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
		array_push($child_users, Auth::user()->id);

      	if(!Entrust::can('edit_ticket') || (!Entrust::can('manage_everyone_ticket') && Entrust::can('manage_subordinate_ticket') && !in_array($ticket->user_id, $child_users) ))
          	return redirect('/dashboard')->withErrors(config('constants.NA'));

		$custom_field_values = Helper::getCustomFieldValues($this->form,$ticket->id);
		return view('ticket.edit',compact('ticket','custom_field_values'));
	}

	public function store(TicketRequest $request, Ticket $ticket){	

		if(!Entrust::can('create_ticket'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$data = $request->all();
	    $ticket->fill($data);
	    $ticket->ticket_status = 'open';
	    $ticket->user_id = Auth::user()->id;
		$ticket->save();
		
		Helper::storeCustomField($this->form,$ticket->id, $data);

		$activity = 'New Ticket added';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function update(TicketRequest $request, Ticket $ticket){

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);
		$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
		array_push($child_users, Auth::user()->id);

      	if(!Entrust::can('edit_ticket') || (!Entrust::can('manage_everyone_ticket') && Entrust::can('manage_subordinate_ticket') && !in_array($ticket->user_id, $child_users) ))
          	return redirect('/dashboard')->withErrors(config('constants.NA'));

		$data = $request->all();
		$ticket->fill($data);
		$ticket->save();
		Helper::updateCustomField($this->form,$ticket->id, $data);
		$activity = 'Ticket updated';
		Activity::log($activity);
		return redirect('/ticket')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Ticket $ticket){
		
		$child_locations = Helper::childLocation(Auth::user()->location_id,1);
		$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
		array_push($child_users, Auth::user()->id);

      	if(!Entrust::can('delete_ticket') || (!Entrust::can('manage_everyone_ticket') && Entrust::can('manage_subordinate_ticket') && !in_array($ticket->user_id, $child_users) ))
          	return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		Helper::deleteCustomField($this->form, $ticket->id);
        
		$activity = 'Ticket deleted';
		Activity::log($activity);
		$ticket->delete();
        return redirect('/ticket')->withSuccess(config('constants.DELETED'));
	}
}
?>