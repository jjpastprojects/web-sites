<?php

namespace Lembarek\Auth\Controllers;

use Auth;
use Redirect;
use Event;
use Hash;
use Lembarek\Auth\Events\UserHasCreated;
use Lembarek\Auth\Requests\RegisterRequest;
use Lembarek\Auth\Requests\LoginRequest;
use Lembarek\Auth\Repositories\UserRepositoryInterface;

class AuthController extends Controller
{

    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
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
        return view('auth::register');
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

        return Redirect::to('/');
    }


    /**
     * show the login page
     *
     * @return Response
     */
    public function login()
    {
        return view('auth::login');
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

        $attemp = Auth::attempt($inputs, !!$rememberme);

        if (!$attemp) {
            $request->session()->flash('error', trans('auth.failed'));
            return Redirect::back();
        }

        return Redirect::intended('/');

    }


    /**
     * logout
     *
     * @param  string  $
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return Redirect::route('core::home');
    }
}
