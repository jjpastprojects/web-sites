<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Event;
use Hash;
use App\Events\UserHasCreated;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepository;

class AuthController extends Controller
{

    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }


    /**
     * register a new user
     *
     * @return boolean
     */
    public function register()
    {
        return view('auth.register');
    }


    /**
     * create a new user in DB
     *
     * @return Response
     */
    public function postRegister(RegisterRequest $request)
    {
        $inputs = $request->except('_token');
        $inputs['password'] = Hash::make($inputs['password']);
        $user = $this->userRepo->create($inputs);

        Event::fire(new UserHasCreated($user));

        return Redirect::route('home');
    }


    /**
     * show the login page
     *
     * @return Response
     */
    public function login()
    {
        return view('auth.login');
    }


    /**
     * try to login the user
     *
     * @return Response
     */
    public function postLogin(LoginRequest $request)
    {
        $inputs = $request->except('_token','rememberme');

        $rememberme = $request->get('rememberme');

        $attemp = auth()->attempt($inputs, !!$rememberme);

        if (!$attemp) {
            return Redirect::back();
        }

        return Redirect::intended(route('home'));

    }


    /**
     * logout
     *
     * @param  string  $
     * @return Response
     */
    public function logout()
    {
        logout();
        return Redirect::route('home');
    }
}
