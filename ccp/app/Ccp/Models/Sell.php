<?php namespace Ccp\Models;

class Sell extends \Eloquent{
	protected $fillable = array('paypal','paypal_first_name','paypal_last_name','amount','ccp','first_name','last_name','email','phone_number','activate');
}
