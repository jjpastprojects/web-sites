<?php namespace Lem\Profile\Interfaces;

Interface UserValueInterface
{
    public function exists($user_id, $var_id, $value);
    public function validateCondition($user_id, $variable_id, $operator, $value);
}
