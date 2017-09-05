<?php namespace Lem\Profile;


/**
* to execute tasks
**/
class Profile
{

    public function __construct()
    {
        $this->userValueRepo = new \Lem\Profile\Repositories\UserValueRepository();
        $this->variableRepo = new \Lem\Profile\Repositories\VariableRepository();
        $this->enumRepo = new \Lem\Profile\Repositories\EnumRepository();
        $this->userVariableRepo = new \Lem\Profile\Repositories\UserVariableRepository();
    }


    /**
     * get Value for specific user and variable
     *
     * @param  integer  $user_id
     * @param  integer  $variable_id
     * @return string
     */
    public function getValue($user_id, $variable_id)
    {
            return $this->userValueRepo->getValue($user_id, $variable_id);
    }


    /**
     * create a new variable
     *
     * @param  string  $name
     * @return \Lem\Profile\Models\Variable
     */
    public function createVariable($columns = [])
    {
        return $this->variableRepo->create($columns);
    }


    /**
     * create a new recored in enums table
     *
     * @param  array  $columns
     * @return \Lem\Profile\Models\Enum
     */
    public function createEnum($columns = [])
    {
        return $this->enumRepo->create($columns);
    }


    /**
     * get a variable id by its name
     *
     * @param  string  $name
     * @return \Lem\Profile\Models\Variable
     */
    public function getVariableByName($name)
    {
        return $this->variableRepo->getVariableByName($name);
    }


    /**
     * get variable by id
     *
     * @param  integer  $variable_id
     * @return \Lem\Profile\Models\Variable
     */
    public function getVariableById($variable_id)
    {
        return $this->variableRepo->where('id', '=', $variable_id)->first();
    }


    /**
     * get enum by variable id
     *
     * @param  integer  $variable_id
     * @return \Lem\Profile\Models\Enum
     */
    public function getEnumByVariableId($variable_id)
    {
        return $this->enumRepo->getByVariableId($variable_id);
    }


    /**
     * add variable to a user
     *
     * @param  integer  $user_id
     * @param  integer  $variable_id
     * @return boolean
     */
    public function addVariableToUser($user_id, $variable_id)
    {
        $this->userVariableRepo->create(['user_id' => $user_id, 'variable_id' => $variable_id]);
    }


    /**
     * get all variable for user
     *
     * @param  integer  $user_id
     * @return \Lem\Profile\Models\UserValue
     */
    public function getAllVariableWithValue($user_id)
    {
        return $this->userValueRepo->where('user_id', '=', $user_id);
    }


    /**
     * update user value
     *
     * @param  integer  $user_id
     * @param  integer  $variable_id
     * @param  string   $values
     * @return \Lem\Profile\Models\UserValue
     */
    public function updateValue($user_id, $variable_id, $values)
    {
        $this->userValueRepo->update($user_id, $variable_id, $values);
    }


    /**
     * delete a value
     *
     * @param  integer  $user_id
     * @param  integer  $variable_id
     * @return boolean
     */
    public function deleteValue($user_id, $variable_id)
    {
        return $this->userValueRepo->where('user_id', '=', $user_id)->where('variable_id', '=', $variable_id)->delete();
    }


    /**
     * check if user has variable
     *
     * @param  integer  $user_id
     * @param  integer  $variable_id
     * @return boolean
     */
    public function hasVariable($user_id, $variable_id)
    {
       $variable = $this->userVariableRepo->where('user_id', '=', $user_id)->where('variable_id', '=', $variable_id)->get();
       return count($variable) == 1;
    }


    /**
     * get all undefined variables
     *
     * @param  integer  $user_id
     * @return array
     */
    public function getUndefinedVariables($user_id)
    {
        $v1= array_values(array_dot($this->userVariableRepo->where('user_id', '=', $user_id)->get(['variable_id'])->toArray()));
        $v2= array_values(array_dot($this->userValueRepo->where('user_id', '=', $user_id)->get(['variable_id'])->toArray()));

        $v = array_where($v1, function($key, $value)use($v2){
            return !in_array($value, $v2);
        });
        return $v;
    }
}
