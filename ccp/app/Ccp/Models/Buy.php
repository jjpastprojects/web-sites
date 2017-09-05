<?php namespace Ccp\Models;

class Buy extends \Eloquent{
	protected $fillable = array('paypal','amount','ccp','img','email','phone_number','activate','txt_id','finish');
}
