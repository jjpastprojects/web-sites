<?php
namespace App\Http\Controllers;
use App\Classes\Helper;
use Config;
use App\TicketAttachment;
use File;
use Activity;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\TicketAttachmentRequest;

Class TicketAttachmentController extends Controller{

	public function store(TicketAttachmentRequest $request, TicketAttachment $ticket_attachment){

		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		$filename = uniqid();

	    $data = $request->all();

     	if ($request->hasFile('file')) {
	 		$extension = $request->file('file')->getClientOriginalExtension();
	 		$file = $request->file('file')->move('uploads/attachment_files/', $filename.".".$extension);
	 		$data['file'] = $filename.".".$extension;
		 }
		 
		$data['attachment_username'] = Auth::user()->username;
		$ticket_attachment->fill($data);
		$ticket_attachment->save();

		$activity = 'Attached a file on a task';
		Activity::log($activity);

		return redirect('/ticket/'.$request->input('ticket_id')."#attachment")->withSuccess(config('constants.SAVED'));
	}

	public function destroy(TicketAttachment $ticket_attachment){
		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		if($ticket_attachment->attachment_username != Auth::user()->username && !Entrust::hasRole('admin'))
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));

		$id = $ticket_attachment->Ticket->id;
		File::delete('uploads/attachment_files/'.$ticket_attachment->file);
		$ticket_attachment->delete();
		$activity = 'Deleted a file on a task';
		Activity::log($activity);
		return redirect('/ticket/'.$id.'#attachment')->withSuccess(config('constants.DELETED'));
	}
}
?>