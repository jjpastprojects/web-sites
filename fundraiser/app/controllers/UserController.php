<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\MessageBag;

class UserController extends Controller{
    public function loginAction(){
        
        $errors=new MessageBag();
        
        if ($old=Input::old("errors")){
            $errors= $old;
        }                
        
        $data =[
            "errors" => $errors,
            "signup_errors" => new MessageBag()
        ];
        
        if (Input::server("REQUEST_METHOD") == "POST"){
          
            $validator = Validator::make(Input::all(),[
                "userid" => "required",
                "password" => "required"
            ]);
            
            if ($validator->passes()){
              
                $credentials =[
                    "userid" => Input::get("userid"),
                    "password" => Input::get("password")
                ];
                
                if (Auth::attempt($credentials)){
                
                    return Redirect::route("user/profile");
                }
            }
            
            $data['errors'] = new MessageBag([
                "password" => [
                    "User ID and/or password invalid."
                ]
            ]);

            $data["userid"] = Input::get("userid");
             
            return Redirect::route("home")->withInput($data);
            
       }
        
        return View::make("home", $data);
    }
    
    public function requestAction(){
        $data=[
            "requested" => Input::old("requested")
        ];
        
        if (Input::server("REQUEST_METHOD") =="POST"){
            $validator =Validator::make(Input::all(),[
               "email"  => "required"
            ]);
            
            if ($validator->passes()){
                $credentials=[
                    "email" => Input::get('email')
                ];
                
                Password::remind($credentials,
                        function($message,$user){
                            $message->from("georgi@gmail.com");
                        }
                );
                
                $data["required"]=true;
                
                return Redirect::route("user/request") ->withInput($data);
                
            }
        }
        
        return View::make("user/request",$data);
    }
    
    public function resetAction(){
        $token = "?token=".Input::get("token");
        $errors= new MessageBag();
        
        if ($old = Input::old("errors")){
            $errors= $old;
        }
        
        $data=[
            "token" =>$token,
            "errors" => $errors
        ];
        
        if (Input::server("REQUEST_METHOD")=="POST"){
            
            $validator = Validator::make( Input::all(),[
                "email" => "required|email",
                "password" => "required|min:6",
                "password_confirmation" => "same:password",
                "token" => "exists:token,token",
            ]);
            
            if ($validator->passes()){
                $credentials=[
                    "email" => Input::get("email"),
                    "password" => Input::get("password"),
                    "password_confirmation"  => Input::get("password_confirmation"),
                    "token"  => Input::get("token"),
                ];
                
                Password::reset($credentials,
                    function ($user,$password){
                        $user->password = Hash::make($password);
                        $user->save();
                        
                        Auth::login($user);
                        
                        return Redirect::route("user/profile");
                    }
               );
            }
            
            $data["email"] = Input::get("email");
            $data["errors"] = $validator-> errors();
            
            return Redirect::to(URL::route("user/reset").$token)->withInput($data);
            
        }
        
        return View::make("user/reset",$data);
    }
    
    
   public function registerAction(){
        
        $token = "?token=".Input::get("token");
        $errors= new MessageBag();
        
        if ($old = Input::old("signup_errors")){
            $errors= $old;
        }
        
        $data=[            
            "signup_errors" => $errors
        ];
        
        if (Input::server("REQUEST_METHOD")=="POST"){
            
            $validator = Validator::make( Input::all(),[
                "email" => "required|email|unique:users",
                "userid" => "required|unique:users",
                "password" => "required|min:6|confirmed",
                "password_confirmation" => "same:password",                
            ]);
            
            if ($validator->passes()){
                
                
                $user = new User();
                
                $user->userid = Input::get('userid');
                $user->email = Input::get('email');
                $user->password = Hash::make(Input::get('password'));
                $user->save();

                //Login after save
                 $credentials =[
                    "userid" => Input::get("userid"),
                    "password" => Input::get("password")
                ];
                
                if (Auth::attempt($credentials)){                
                    return Redirect::route("user/profile");
                }
            }
            
            $data["email"] = Input::get("email");
            $data["signup_errors"] = $validator->errors();
            
            return Redirect::to(URL::route("home"))->withInput($data);
            
        }
        
        return View::make("user/reset",$data);
    }
    
    public function profileAction(){
        return View::make("user/profile");
    }
    
    public function logoutAction(){
        Auth::logout();
        return Redirect::route("home");
    }
}
