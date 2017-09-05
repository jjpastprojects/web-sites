<?php namespace Lem\Profile\Interfaces;

use Lem\Profile\Models\UserVariable;
use Lem\Profile\Repositories\EnumRepository;

Interface UserVariableInterface
{
    public function exists($variable_id, $user_id);
}

