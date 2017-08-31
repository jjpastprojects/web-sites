<?php

namespace App\Http\Controllers\Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Role;
use App\Location;
use App\Http\Requests\RegisterRequest;
use Entrust;
use App\Profile;
use App\Classes\Helper;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout','getRegister','postRegister']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getRegister()
    {
        if(!Entrust::can('create_employee'))
            return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(Entrust::can('manage_all_employee'))
            $locations = Location::lists('location','id')->all();
        else
            $locations = Helper::childLocation(Auth::user()->location_id);
        
        if(Entrust::hasRole('admin'))
            $roles = Role::lists('name','id')->all();
        else
            $roles = Role::where('name','!=','admin')->lists('name','id')->all();

        return view('employee.create',compact('locations','roles'));
    }

    public function postRegister(RegisterRequest $request, User $user){
        
        if(!Entrust::can('create_employee'))
            return redirect('/dashboard')->withErrors(config('constants.NA'));

        $user->fill($request->all());
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $profile = new Profile;
        $profile->user()->associate($user);
        $profile->employee_code = $request->input('employee_code');
        $profile->save();
        $user->attachRole($request->input('role_id'));
        return redirect()->back()->withSuccess('Employee created successfully. ');
    }
    
    protected $username = 'username';
    protected $redirectPath = '/dashboard';
    protected $loginPath = '/login';
}
