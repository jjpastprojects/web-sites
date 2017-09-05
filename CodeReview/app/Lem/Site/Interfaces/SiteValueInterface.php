<?php namespace Lem\Site\Interfaces;



interface SiteValueInterface
{


    /**
     * check if the $site_id, $variable_id and $value exists
     * in the same line
     *
     * @param  integer  $variable_id
     * @param  integer  $value
     * @return boolean
     */
    public function exists($variable_id, $value);

    /**
     * to check if the condition is valide
     *
     * @param  integer $variable_id
     * @param  string $operator
     * @param  string $value
     * @return boolean
     */
    public function validateCondition($variable_id, $operator, $value);

}
