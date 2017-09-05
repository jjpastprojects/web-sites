<?php namespace Lem\User\Repositories;

class UserRepository
{

    public function __construct()
    {
        $this->userModel = new \Lem\User\Models\User();
    }


    /**
     * find
     *
     * @param  string  $
     * @return \Lem\User\Models\User
     */
    public function find($user_id)
    {
        return $this->userModel->findOrFail($user_id);
    }


    /**
     * get all ids of users
     *
     * @param  string  $
     * @return array
     */
    public function getAllIds()
    {
         return array_divide(array_dot($this->userModel->get(['id'])->toArray()))[1];
    }


    /**
     * create a new recored
     *
     * @param  string  $name
     * @return \Lem\User\Models\Users
     */
    public function create($name, $email, $password)
    {
        return $this->userModel->create(['name' => $name, 'email' => $email, 'password' => $password]);
    }


    /**
     * get pages for user
     *
     * @param  string  $columns
     * @return Array
     */
    public function pages($user_id, $columns = ['title', 'body', 'code'])
    {
        $pages = $this->userModel->find($user_id)->pages()->get($columns)->toArray();
        return $pages;
    }


    /**
     * get all users
     *
     * @param  string  $a
     * @return \Lem\User\Models\User
     */
    public function all()
    {
        return $this->userModel->all();
    }


}

