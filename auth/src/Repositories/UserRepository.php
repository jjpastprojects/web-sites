<?php

 namespace Lembarek\Auth\Repositories;

use App\Models\User;

class UserRepository extends Repository implements UserRepositoryInterface
{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * get a single user by its username
     *
     * @param  string  $username
     * @return User
     */
    public function byUsername($username, $with=[])
    {
        $user = $this->model->whereUsername($username);
        foreach($with as $relation)
            $user = $user->with($relation);
        return $user->first();
    }
}
