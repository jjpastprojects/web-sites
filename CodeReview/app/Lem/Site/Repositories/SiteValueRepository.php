<?php namespace Lem\Site\Repositories;


use Lem\Site\Interfaces\SiteValueInterface;
use Lem\Site\Models\SiteValue;

class SiteValueRepository implements SiteValueInterface
{


    /**
     * the SiteValue Model
     *
     * @var Lem\Profile\Models\SiteValue
     */
     protected $siteValueModel;


    public function __construct()
    {
        $this->siteValueModel = new SiteValue();
    }


    /**
     * check if the $site_id, $variable_id and $value exists
     * in the same line
     *
     * @param  integer  $site_id
     * @param  integer  $variable_id
     * @param  integer  $value
     * @return boolean
     */
    public function exists($variable_id, $value)
    {
        $count = $this->siteValueModel->whereVariableId($variable_id)->whereValue($value)->count();
        if($count == 1) return true;
        else return false;
    }


    /**
     * to check if the condition is valide
     *
     * @param  integer $variable_id
     * @param  string $operator
     * @param  string $value
     * @return boolean
     */
    public function validateCondition($variable_id, $operator, $value)
    {
        $count  = $this->siteValueModel->whereVariableId($variable_id)->where('value', $operator, $value)->count();
        if($count == 1) return true;
        else return false;
    }


}
