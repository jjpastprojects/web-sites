<?php namespace Lem\Profile\Interfaces;

Interface VariableInterface
{
    public function variableExistsByName($name);

    public function getVariableByName($name);

    public function isValideValue($name, $value);

}
