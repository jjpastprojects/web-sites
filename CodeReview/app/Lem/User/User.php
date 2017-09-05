<?php namespace Lem\User;


use App\Facades\Page;
use Lem\User\Repositories\UserRepository;

/**
* to execute users
**/
class User
{

    protected   $userRepo ;

    protected $conditionRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository();
    }


    /**
     * find a user by id
     *
     * @param  integer  $user_id
     * @return \Lem\User\Models\User
     */
    public function find($user_id)
    {
        return $this->userRepo->find($user_id);
    }


    /**
     * get All Userids
     *
     * @param  string  $
     * @return array
     */
    public function getAllIds()
    {
        return $this->userRepo->getAllIds();
    }


    /**
     * create a new user
     *
     * @param  string  $name
     * @param  string  $email
     * param   string  $password
     * @return \Lem\User\Models\User
     */
    public function create($name, $email, $password)
    {
        return $this->userRepo->create($name, $email, $password);
    }


    /**
     * get all pages for current login user
     *
     * @return array
     */
    public function pages($user_id, $columns = ['title', 'body', 'code'], $status = [])
    {
        $pages = $this->userRepo->pages($user_id, $columns);
        $pages = array_where($pages, function($key, $value) use($status){
            return Page::haveStatus($value['pivot']['user_id'], $value['pivot']['page_id'], $status);
        });
        return $pages;
    }


    /**
     * get all roles for a user
     *
     * @param  integer  $user_id
     * @return array
     */
    public function getRoles($user_id = "")
    {
        $user_id  = $user_id? $user_id: \Auth::user()->id;
        $names = [];
        $roles =  $this->find($user_id)->roles()->get(['name'])->toArray();
        foreach ($roles as $role) {
            $names[] = $role['name'];
        }
        return $names;
    }


    /**
     * check if a user has a role
     *
     * @param  string  $
     * @return boolean
     */
    public function hasRole($role, $user_id = "")
    {
        $user_id = $user_id? $user_id: \Auth::user()->id;
        $roles = $this->getRoles($user_id);
        return in_array($role, $roles);
    }


    /**
     * get all users
     *
     * @param  string  $
     * @return \Lem\User\Models\User
     */
    public function all()
    {
        return $this->userRepo->all();
    }


    /**
     * get current login user
     *
     * @param  string  $
     * @return \Lem\User\Models\User
     */
    public function getCurrentUser()
    {
        if(\Auth::check())
            return \Auth::user();
        return null;
    }


}
