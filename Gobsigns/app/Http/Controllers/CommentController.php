<?php
namespace App\Http\Controllers;
use DB;
use App\Comment;
use Auth;
use Activity;
use Config;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

Class CommentController extends Controller{

	public function store(CommentRequest $request, Comment $comment){

	    $comment->fill($request->all());
	    $comment->comment_username = Auth::user()->username;
	    $comment->save();
		$activity = 'Commented on a task';
		Activity::log($activity);
	    
	    return redirect('/task/'.$request->input('task_id')."#comment")->withSuccess(config('constants.SAVED'));
	}

	public function destroy(Comment $comment){
		if($comment->comment_username != Auth::user()->username && !Entrust::hasRole('admin'))
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));

		$id = $comment->Task->id;
		$comment->delete();
		$activity = 'Deleted a commented on a task';
		Activity::log($activity);
		return redirect('/task/'.$id.'#comment')->withSuccess(config('constants.DELETED'));
	}
}
?>