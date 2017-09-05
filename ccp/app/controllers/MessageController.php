<?php

class MessageController extends BaseController{

	function ShowMessages(){
		if(Input::has('status')){
			$status = Input::get('status');
			$messages = Message::where('user_id','=',Auth::user()->id)->where('status','=',$status);
		}else{
			$messages = Message::where('user_id','=',Auth::user()->id);
		}

		return View::make('message.ShowMessages')->with('messages',$messages->paginate(2));
	}

	function ShowMessage($id){
		$message = Message::where('user_id','=',Auth::user()->id)->where('id','=',$id)->where('status','!=','delete');
		if($message->count() == 0){
			return Redirect::route('home')
			->with('global',Lang::get('refer.not_your_message'));
		}else{
			$message = $message->first();
			$message->status = 'read';
			$message->save();
			return View::make('message.ShowMessage')->with('message',$message);
		}
	}

	function Delete($id){
		$message = Message::where('user_id','=',Auth::user()->id)->where('id','=',$id)->where('status','!=','delete');
		if($message->count() == 0){
			return Redirect::route('home')
			->with('global',Lang::get('refer.not_your_message'));
		}else{
			$message = $message->first();
			$message->status = 'delete';
			$message->save();
			return Redirect::route('ShowMessages');
		}	
	}
}