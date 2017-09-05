<?php

namespace Lembarek\Admin\Controllers;

use Lembarek\Admin\Requests\CreateUserRequest;
use Lembarek\Admin\Requests\UpdateUserRequest;
use Illuminate\Contracts\Auth\Access\Gate;
use Lembarek\Auth\Repositories\UserRepositoryInterface;
use Lembarek\Role\Repositories\RoleRepositoryInterface;

class UsersController extends Controller
{
    protected $userRepo;

    protected $roleRepo;

    public function __construct(UserRepositoryInterface $userRepo, RoleRepositoryInterface $roleRepo)
    {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $direction = request()->get('direction');
        $orderby = request()->get('orderby');

        $users = $this->userRepo->getPaginatedAndOrdered();
        return view('admin::users.index', compact('users', 'orderby', 'direction'));
    }

    /**
     * show the profile of the user in dashboard
     *
     * @param  string  $username
     * @return Response
     */
    public function show($username)
    {
        $user = $this->userRepo->byUsername($username, ['roles']);
        return view('admin::users.show', compact('user'));
    }

    /**
     * detele a user
     *
     * @param  string  $username
     * @return Response
     */
    public function destroy($username)
    {
        $user = $this->userRepo->byUsername($username);
        if(auth()->user()->isSuperiorThen($user))
            $user->delete();

        return redirect()->route('admin::users.index');
    }

    /**
     * create a new user
     *
     * @return Reponse
     */
    public function create()
    {
        return view('admin::users.create');
    }

    /**
     * post create user
     *
     * @return Reponse
     */
    public function store(CreateUserRequest $request, Gate $gate)
    {
       if($gate->allows('create-users')){
            $this->userRepo->create($request->all());
            return redirect()->route('admin::users.index');
        }

       return redirect()
              ->route('admin::dashboard')
              ->with('flash.message', trans('admin::users.can_not_create_user'));
    }

    /**
     * edit the users profile
     *
     * @param  string  $username
     * @return Response
     */
    public function edit($username)
    {
        $user = $this->userRepo->byUsername($username);
        return view('admin::users.edit', compact('user'));
    }

    /**
     * update existing user
     *
     * @param  string  $username
     * @return Response
     */
    public function update(UpdateUserRequest $request,Gate $gate,  $username)
    {
        if($gate->allows('edit-users')){
            $this->userRepo->byUsername($username)->profile()->update($request->except('_token', '_method'));;
            return back();
        }
        return redirect()
            ->route('admin::dashboard')
            ->with('flash.message', trans('admin::users.can_not_create_user'));
    }
}
