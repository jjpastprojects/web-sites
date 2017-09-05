<?php

namespace Lembarek\Admin\Controllers;

use Lembarek\Admin\Requests\CreateRoleUserRequest;
use Lembarek\Auth\Repositories\UserRepositoryInterface;
use Lembarek\Role\Repositories\RoleRepositoryInterface;


class RoleUserController extends Controller
{
    protected $userRepo;

    protected $roleRepo;

    public function __construct(UserRepositoryInterface $userRepo, RoleRepositoryInterface $roleRepo)
    {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(CreateRoleUserRequest $request)
    {
        $input = request()->only('role', 'user');

        $role = $this->roleRepo->find($input['role']);

        if(auth()->user()->canAddRole($role))

            $this->userRepo->find($input['user'])->assignRole($role);

        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($userId, $roleId)
    {
        $user = $this->userRepo->find($userId);

        if(auth()->user()->canDeleteRole($user)){
            $user->roles()->detach($roleId);
        }

        return back();
    }

}
