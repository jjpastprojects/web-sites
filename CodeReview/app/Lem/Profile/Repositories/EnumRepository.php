<?php namespace Lem\Profile\Repositories;

use Lem\Profile\Interfaces\EnumInterface;
use Lem\Profile\Models\Enum;

class EnumRepository implements EnumInterface
{
    /**
     * the Enum Model
     *
     * @var Lem\Profile\Models\Enum
     */
     protected $enumModel;


    public function __construct()
    {
        $this->enumModel = new Enum();
    }


    /**
     * get all values by variable id
     *
     * @param  integer  $variableId
     * @return array
     */
    public function getValuesByVariableId($variableId)
    {
        $values = $this->enumModel->whereVariableId($variableId)->get(['values'])->first()['values'];
        return preg_split("/[, ]+/",$values);
    }


    /**
     * create a new record to enums tables
     *
     * @param  array $columns
     * @return \Lem\Profile\Models\Enum
     */
    public function create($columns)
    {
       return  $this->enumModel->create($columns);
    }


    /**
     * get Enum by Variable Id
     *
     * @param  integer  $variable_id
     * @return \Lem\Profile\Models\Enum
     */
    public function getByVariableId($variable_id)
    {
        return $this->enumModel->whereVariableId($variable_id)->first();
    }


}
