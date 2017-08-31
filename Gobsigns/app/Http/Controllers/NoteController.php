<?php
namespace App\Http\Controllers;
use DB;
use App\Note;
use Illuminate\Http\Request;
use Config;
use Auth;

Class NoteController extends Controller{

	public function update(Request $request, $id = 0){

	    $note = Note::findOrNew($id);
	    $note->fill($request->all());
	    $note->note_username = Auth::user()->username;
	    $note->save();

	    return redirect('/task/'.$request->input('task_id')."#note")->withSuccess(config('constants.SAVED'));
	}

	public function store(Request $request){

	    $note = new Note;
	    $note->fill($request->all());
	    $note->note_username = Auth::user()->username;
	    $note->save();
	    
	    return redirect('/task/'.$request->input('task_id')."#note")->withSuccess(config('constants.SAVED'));
	}
}
?>