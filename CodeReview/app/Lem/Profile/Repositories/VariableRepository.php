<?php namespace Lem\Profile\Repositories;

use Lem\Profile\Interfaces\VariableInterface;
use Lem\Profile\Models\Variable;
use Lem\Profile\Repositories\EnumRepository;

class VariableRepository implements VariableInterface
{

    /**
     * to get the enums array from the enums table when the type is
     * enum
     *
     * @var Lem\Profile\Repositories\EnumRepository
     */
    protected $enumRepo;


    /**
     * the variable models
     *
     * @var Lem\Profile\Models\Variable
     */
     protected $variableModel ;


    public function __construct()
    {
        $this->variableModel = new Variable();
        $this->enumRepo = new EnumRepository();
    }


    /**
     * where
     *
     * @param  array  $columns
     * @return \Lem\Profile\Models\Variable
     */
    public function where($name,$operator,$value)
    {
        return $this->variableModel->where($name, $operator, $value);
    }


    /**
     * check if the $var exists the table
     *
     * @param  string  $var
     * @return boolean
     */
    public function variableExistsByName($name)
    {
         $count = $this->variableModel->where('name', '=' ,$name)->get()->count();
            if($count == 1)return true;
            else return false;
    }


    /**
     * get the id by name
     *
     * @param  string  $name
     * @return \Lem\Profile\Models\Variable
     */
    public function getVariableByName($name)
    {
        return $this->variableModel->whereName($name)->first();
    }


    /**
     * check if the $name, $value
     *
     * @param  string  $name
     * @param  string  $value
     * @return boolean
     */
    public function isValideValue($name, $value)
    {
        if(!$this->variableExistsByName($name)) return false;

        $type  = $this->where('name', '=',$name)->first()->type;
        $varId = $this->where('name', '=',$name)->first()->id;

        if($type == "enum"){
            $values = $this->enumRepo->getValuesByVariableId($varId);
            return in_array($value, $values);
        }

        if($type == 'integer'){
            return floatval($value);
        }

        if($type == 'date'){
            if(strtotime($value)) return true;
            else return false;
        }
        if($type == 'boolean'){
            return in_array($value, ['true', 'false']);
        }

        if($value) return true;

        return false;
    }


    /**
     * create a new record
     *
     * @param  array $columns
     * @return void
     */
    public function create($columns)
    {
        return $this->variableModel->create($columns);
    }


    /**
     * find the variable by its id
     *
     * @param  integer  $variable_id
     * @return \Lem\Profile\Modes\Variable
     */
    public function find($variable_id)
    {
        return $this->variableModel->findOrFail($variable_id);
    }


}
