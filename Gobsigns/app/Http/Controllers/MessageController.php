<?php
namespace App\Http\Controllers;
use DB;
use Config;
use App\Classes\Helper;
use Auth;
use App\Message;
use Entrust;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;

Class MessageController extends Controller{

	public function inbox(){

		if(!Entrust::can('manage_message'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$messages = DB::table('messages')
			->where('to_user_id','=',Auth::user()->id)
			->where('delete_receiver','=','0')
			->join('users','users.id','=','messages.from_user_id')
        	->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,messages.created_at,messages.subject,messages.id,messages.read,attachment'))
			->get();

        $token = csrf_token();

        $count_inbox = count($messages);
        $count_sent = Message::where('from_user_id','=',Auth::user()->id)
			->where('delete_sender','=','0')
        	->count();

        $col_data=array();
        foreach($messages as $message){

			$Option = "<a href='message/view/$message->id/$token' class='btn btn-default btn-xs' data-toggle='tooltip' title='View'> <i class='fa fa-share'></i></a> ";
			$Option .= "<a href='message/$message->id/delete/$token' class='btn btn-default btn-xs alert_delete'  data-toggle='tooltip' title='Delete'> <i class='fa fa-trash-o'></i></a>";
			
			$from = $message->full_name;

			if(!$message->read)
			$from = "<strong>$from</strong>";

			$col_data[] = array('<div class="btn-group btn-group-xs">'.$Option.'</div>', $from,
					$message->subject,
					Helper::showDateTime($message->created_at),
					($message->attachment != '') ? '<i class="fa fa-paperclip"></i>' : ''
					);	
        }

        $col_heads = [trans('messages.Option'),trans('messages.From'),trans('messages.Subject'),trans('messages.Date & Time'),''];
        Helper::writeResult($col_data);

        $data = [
        	'count_inbox' => $count_inbox,
        	'count_sent' => $count_sent,
        	'col_heads' => $col_heads
        	];

		return view('message.inbox',$data);
	}

	public function compose(){

		if(!Entrust::can('manage_message'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $users = DB::table('users')
        	->where('users.id','!=',Auth::user()->id)
        	->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

		$messages = Message::where('to_user_id','=',Auth::user()->id)
			->where('delete_receiver','=','0')
			->get();
        $count_inbox = count($messages);
        $count_sent = Message::where('from_user_id','=',Auth::user()->id)
			->where('delete_sender','=','0')
        	->count();

		$data = [
			'users' => $users,
			'count_inbox' => $count_inbox,
			'count_sent' => $count_sent
			];
		return view('message.compose',$data);
	}

	public function sent(){

		if(!Entrust::can('manage_message'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
		$messages = DB::table('messages')
			->where('from_user_id','=',Auth::user()->id)
			->where('delete_sender','=','0')
			->join('users','users.id','=','messages.to_user_id')
        	->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,messages.created_at,messages.subject,messages.id,attachment'))
			->get();
		
        $token = csrf_token();

        $count_sent = count($messages);
        $count_inbox = Message::where('to_user_id','=',Auth::user()->id)
			->where('delete_receiver','=','0')
        	->count();

        $col_data=array();
        foreach($messages as $message){
			$Option = "<a href='/message/view/$message->id/$token' class='btn btn-default btn-xs' data-toggle='tooltip' title='View'> <i class='fa fa-share'></i></a> ";
			$Option .= "<a href='/message/$message->id/delete/$token' class='btn btn-default btn-xs alert_delete' data-toggle='tooltip' title='Delete'> <i class='fa fa-trash-o'></i></a>";

			$col_data[] = array('<div class="btn-group btn-group-xs">'.$Option.'</div>', $message->full_name,
					$message->subject,
					Helper::showDateTime($message->created_at),
					($message->attachment != '') ? '<i class="fa fa-paperclip"></i>' : ''
					);	
        }

        $col_heads = [trans('messages.Option'),trans('messages.From'),trans('messages.Subject'),trans('messages.Date & Time'),''];
        Helper::writeResult($col_data);

        $data = [
        	'count_inbox' => $count_inbox,
        	'count_sent' => $count_sent,
        	'col_heads' => $col_heads
        	];

		return view('message.sent',$data);
	}

	public function store(MessageRequest $request){	

		if(!Entrust::can('manage_message'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
		$data = $request->all();
		$filename = uniqid();
     	if ($request->hasFile('file')) {
	 		$extension = $request->file('file')->getClientOriginalExtension();
	 		$file = $request->file('file')->move('assets/attachments/', $filename.".".$extension);
	 		$data['attachment'] = $filename.".".$extension;
		 }
		 else
		 	$data['attachment'] = '';

		$message = new Message;
	    $message->fill($data);
	    $message->from_user_id = Auth::user()->id;
	    $message->read = 0;
		$message->save();

		return redirect('/message/compose')->withSuccess("Sent successfully.");	
	}

	public function view($id,$token){

		if(!Entrust::can('manage_message'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

	    if(!Helper::verifyCsrf($token))
	      return redirect('/dashboard')->withErrors(config('constants.CSRF'));

		$message = Message::find($id);

		if(!$message)
			return redirect('/message')->withErrors(config('constants.INVALID_LINK'));

		$query = DB::table('users');
		if($message->from_user_id == Auth::user()->id){
			$message_type = 'sent';
			$query->where('users.id','=',$message->to_user_id);
		}
		elseif($message->to_user_id == Auth::user()->id){
			$message_type = 'inbox';
			$message->read = 1;
			$query->where('users.id','=',$message->from_user_id);
		}
		else
			return redirect('/message')->withErrors('This is not a valid link. ');


    	$user = $query->join('locations','locations.id','=','users.location_id')
    	->join('clients','clients.id','=','locations.client_id')
        ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name'))
		->first();

        $count_inbox = Message::where('to_user_id','=',Auth::user()->id)
			->where('delete_receiver','=','0')
        	->count();
        $count_sent = Message::where('from_user_id','=',Auth::user()->id)
			->where('delete_sender','=','0')
        	->count();

		$message->save();

		$data = [
					'message' => $message,
					'user' => $user,
					'count_inbox' => $count_inbox,
					'count_sent' => $count_sent
				];

		return view('message.view',$data);
	}

	public function delete($id,$token){

		if(!Entrust::can('manage_message'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

	    if(!Helper::verifyCsrf($token))
	      return redirect('/dashboard')->withErrors(config('constants.CSRF'));

		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		$message = Message::find($id);
		if(!$message || ($message->to_user_id != Auth::user()->id && $message->from_user_id != Auth::user()->id))
			return redirect('/message')->withErrors(config('constants.INVALID_LINK'));

		if($message->to_user_id == Auth::user()->id)
		$message->delete_receiver = 1;
		else
		$message->delete_sender = 1;	
		$message->save();

		return redirect('/message')->withSuccess(config('constants.DELETED'));
		
	}
}
?>