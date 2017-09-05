<?php namespace Ccp\Models;

class Message extends Eloquent{
	protected $fillable = array('user_id', 'status','subject','body');
	public function user(){
		return $this->belongsTo('User');
	}
}
