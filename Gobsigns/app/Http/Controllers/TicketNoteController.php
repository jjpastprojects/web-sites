<?php
namespace App\Http\Controllers;
use DB;
use App\TicketNote;
use Illuminate\Http\Request;
use Config;
use Auth;

Class TicketNoteController extends Controller{
	
	public function update(Request $request, $id = 0){

	    $note = TicketNote::findOrNew($id);
	    $note->fill($request->all());
	    $note->note_username = Auth::user()->username;
	    $note->save();

	    return redirect('/ticket/'.$request->input('ticket_id')."#note")->withSuccess(config('constants.SAVED'));
	}

	public function store(Request $request){

	    $note = new TicketNote;
	    $note->fill($request->all());
	    $note->note_username = Auth::user()->username;
	    $note->save();
	    
	    return redirect('/ticket/'.$request->input('ticket_id')."#note")->withSuccess(config('constants.SAVED'));
	}
}
?>