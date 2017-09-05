<?php namespace Lem\Profile\Repositories;


use Lem\Profile\Interfaces\UserValueInterface;
use Lem\Profile\Models\UserValue;

class UserValueRepository implements UserValueInterface
{

    /**
     * the UserValue Model
     *
     * @var Lem\Profile\Models\UserValue
     */
     protected $userValueModel;


    public function __construct()
    {
        $this->userValueModel = new UserValue();
    }


    /**
     * check if the $user_id, $variable_id and $value exists
     * in the same line
     *
     * @param  integer  $user_id
     * @param  integer  $variable_id
     * @param  integer  $value
     * @return boolean
     */
    public function exists($user_id, $variable_id, $value)
    {
        $count = $this->userValueModel->whereUserId($user_id)->whereVariableId($variable_id)->whereValues($value)->count();
        if($count == 1) return true;
        else return false;
    }


    /**
     * to check if the condition is valide
     *
     * @param  integer  $user_id
     * @param  integer $variable_id
     * @param  string $operator
     * @param  string $value
     * @return boolean
     */
    public function validateCondition($user_id, $variable_id, $operator, $value)
    {
        $count  = $this->userValueModel->whereUserId($user_id)->whereVariableId($variable_id)->where('values', $operator, $value)->count();
        if($count == 1) return true;
        else return false;
    }


    /**
     * create a new record
     *
     * @param  integer  $user_id
     * @return \Lem\Profile\Models\UserValue
     */
    public function create($user_id, $variable_id, $values)
    {
        return $this->userValueModel->create(['user_id' => $user_id, 'variable_id' => $variable_id, 'values' => $values]);
    }


    /**
     * get variable ids by user_id
     *
     * @param  integer  $user_id
     * @return array
     */
    public function getVariableIds($user_id)
    {
       return $this->userValueModel->whereUserId($user_id)->get(['variable_id'])->toArray();
    }


    /**
     * get a Value
     *
     * @param  integer  $user_id
     * @return string
     */
    public function getValue($user_id, $variable_id)
    {
        $value = $this->userValueModel->whereUserId($user_id)->whereVariableId($variable_id)->get(['values']);
        if(count($value) == 1) return $value->toArray()[0]['values'];
        else return 'undefined';
    }


    /**
     * where
     *
     * @param  string  $column
     * @param  string  $operator
     * @param  string  $value
     * @return \Lem\Profile\Models\UserValue
     */
    public function where($column, $operator, $value)
    {
        return $this->userValueModel->where($column, $operator, $value);
    }


    /**
     * update a value
     *
     * @param  integer  $user_id
     * @param  integer  $variable_id
     * @param  string   $values
     * @return \Lem\Profile\Models\UserValue
     */
    public function update($user_id, $variable_id, $values)
    {
        $this->userValueModel->whereUserId($user_id)->whereVariableId($variable_id)->update(['values' => $values]);
    }

}
