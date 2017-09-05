<?php


use Illuminate\Support\MessageBag;


class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showHome()
	{
            $errors=new MessageBag();
            $signup_errors=new MessageBag();
        
            if ($old=Input::old("errors")){
                $errors= $old;
            }                
            
            $data =[
                "errors" => $errors
            ];

            if ($old=Input::old("signup_errors")){
                $signup_errors= $old;
            }                
            

            $data['signup_errors'] =$signup_errors;
                
            
            
            return View::make("home", $data);
	}

}
