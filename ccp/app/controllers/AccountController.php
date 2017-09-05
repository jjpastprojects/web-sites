<?php

class AccountController extends BaseController {

    public function getSignIn() {
        return View::make('account.signin');
    }

    public function postSignIn() {
        $validator = Validator::make(Input::all(), array(
                    'email' => 'required|email',
                    'password' => 'required'
        ));

        if ($validator->fails()) {
            return Redirect::route('account-sign-in')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $remember = (Input::has('remember') ? true : false);

            $auth = Auth::attempt(array(
                        'email' => Input::get('email'),
                        'password' => Input::get('password'),
                        'active' => 1
                            ), $remember);
            if ($auth) {
                return Redirect::intended('/');
            }
        }
        return Redirect::route('account-sign-in')
                        ->with('global', Lang::get('general.account-sign-in-problem'));
    }

    public function getCreate() {
        return View::make('account.create');
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), array(
                    'email' => 'required|max:50|email|unique:users',
                    'username' => 'required|max:20|min:1|unique:users',
                    'password' => 'required|min:1',
                    'password_again' => 'required|same:password'
                        )
        );
        if ($validator->fails()) {
            return Redirect::route('account-create')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $email = Input::get('email');
            $username = Input::get('username');
            $password = Input::get('password');

            $code = str_random(60);

            $user = User::create(array(
                        'email' => $email,
                        'username' => $username,
                        'password' => Hash::make($password),
                        'code' => $code,
                        'active' => 0,
                        'level' => 0
            ));


            if ($user) {
//                Mail::send('emails.auth.activate', array('link' => URL::route('account-activate',$code) ,'username'=>$username), function($message) use ($user){
//                    $message->to($user->email, $user->username)->subject('active your account');
//                });
                return Redirect::route('home')
                                ->with('global', Lang::get('general.account-create-success'));
            }
        }
    }

    public function getActivate($code) {
        $user = User::where('code', '=', $code)->where('active', '=', 0);
        if ($user->count()) {
            $user = $user->first();
            $user->active = 1;
            $user->code = 0;
            if ($user->save()) {
                return Redirect::route('home')
                                ->with('global', Lang::get('general.account-activate-msg'));
            }
        }
        return Redirect::route('home')
                        ->with('global', Lang::get('general.account-activate-problem'));
    }

    public function getSignOut() {
        Auth::logout();
        return Redirect::route('home');
    }

}
