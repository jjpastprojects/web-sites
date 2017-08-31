<?php
namespace App\Http\Controllers;
use DB;
use App\TicketComment;
use Auth;
use Activity;
use Config;
use Illuminate\Http\Request;
use App\Http\Requests\TicketCommentRequest;

Class TicketCommentController extends Controller{

	public function store(TicketCommentRequest $request, TicketComment $comment){

	    $comment->fill($request->all());
	    $comment->comment_username = Auth::user()->username;
	    $comment->save();
		$activity = 'Commented on a ticket';
		Activity::log($activity);
	    
	    return redirect('/ticket/'.$request->input('ticket_id')."#comment")->withSuccess(config('constants.SAVED'));
	}

	public function destroy(TicketComment $comment){
		if($comment->comment_username != Auth::user()->username && !Entrust::hasRole('admin'))
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));

		$id = $comment->Ticket->id;
		$comment->delete();
		$activity = 'Deleted a commented on a ticket';
		Activity::log($activity);
		return redirect('/ticket/'.$id.'#comment')->withSuccess(config('constants.DELETED'));
	}
}
?>