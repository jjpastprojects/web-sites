<?php

namespace Lembarek\Admin\Controllers;

use Lembarek\Admin\Requests\CreateRoleRequest;
use Lembarek\Admin\Requests\UpdateRoleRequest;
use Lembarek\Role\Repositories\RoleRepositoryInterface;
use Illuminate\Contracts\Auth\Access\Gate;

class RolesController extends Controller
{

    protected $roleRepo;

    public function __construct(RoleRepositoryInterface $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $roles = $this->roleRepo->all();
        return view('admin::roles.index', compact('roles'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin::roles.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(CreateRoleRequest $request, Gate $gate)
    {
        if($gate->allows('create-roles')){
            $this->roleRepo->create($request->except('_token'));
            return back()->with('flash.message', trans('admin::roles.role_created'));
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $role = $this->roleRepo->find($id);
        return view('admin::roles.edit', compact('role'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateRoleRequest $request,Gate $gate, $id)
    {
        if($gate->allows('edit-roles')){
            $role = $this->roleRepo->find($id);
            $role->update($request->except('_token', '_method'));
            return back()->with('flash.message', trans('admin::roles.role_updated'));
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($role, Gate $gate)
    {
        if($gate->allows('destroy-roles')){
            $this->roleRepo->find($role)->delete();
            return true;
        }
        return false;
    }
}
