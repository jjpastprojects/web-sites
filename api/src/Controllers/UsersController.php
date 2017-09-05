<?php

namespace Lembarek\Api\Controllers;

use Lembarek\Api\Requests\UpdateUserRequest;
use Lembarek\Api\Requests\CreateUserRequest;
use Lembarek\Auth\Repositories\UserRepositoryInterface;

class UsersController extends Controller
{

    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return $this->response($this->userRepo->all());
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  Lembarek\Api\Request\CreateUserRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function store(CreateUserRequest $request)
    {
        $user  = $this->userRepo->create($request->only('username', 'email', 'password'));
        return $this->responseCreate($user);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $user = $this->userRepo->find($id);

        if($user) return $this->response($user);

        return $this->responseNotFound(trans('api::users.user_not_found'));
    }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userRepo->find($id);
        $user->update($request->all());
        $user->save();
        return $this->responseUpdate($user);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $this->userRepo->find($id)->delete();
        return $this->responseDelete(['message' => trans('api::users.user_deleted')]);
    }
}
