<?php namespace Lem\Profile\Repositories;

use Lem\Profile\Interfaces\UserVariableInterface;

class UserVariableRepository implements UserVariableInterface
{

    /**
     * the userVariable model
     *
     * @var Lem\Profile\Models\UserVariable
     */
     protected $userVariableModel ;


     protected $userValueRepo;

     public function __construct()
    {
        $this->userVariableModel =  new \Lem\Profile\Models\UserVariable();
        $this->userValueRepo = new \Lem\Profile\Repositories\UserValueRepository();
    }


    /**
     * check if the $variable_id and $user_id exists
     *
     * @param  integer  $variable_id
     * @param  integer  $user_id
     * @return boolean
     */
    public function exists($variable_id, $user_id)
    {
        $count = $this->userVariableModel->whereUserId($user_id)->whereVariableId($variable_id)->count();
        if($count == 1)return true;
        else return false;
    }


    /**
     * to create a new record
     *
     * @param  integer  $user_id
     * @param  integer  $variable_id
     * @return \Lem\Profile\Models\UserVariable
     */
    public function create($columns)
    {
        $this->userVariableModel->create($columns);
    }


    /**
     * get the first undefined variable for specific user
     *
     * @param  integer  $user_id
     * @return integer
     */
    public function getFirstUndefinedVariableId($user_id)
    {
        $userVariable_ids = array_divide(array_dot($this->userVariableModel->whereUserId($user_id)->get(['variable_id'])->toArray()))[1];

        $valueVariable_ids = array_divide(array_dot($this->userValueRepo->getVariableIds($user_id)))[1];


        foreach ($userVariable_ids as $key => $value) {
            if(!in_array($value, $valueVariable_ids)) return $value;
        }

        return -1;
    }


    /**
     * where
     *
     * @param  string $column
     * @param  string $operator
     * $param  string $value
     * @return \Lem\Profile\Models\UserVariable
     */
    public function where($column, $operator, $value)
    {
        return $this->userVariableModel->where($column, $operator, $value);
    }


}
