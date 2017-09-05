<?php

namespace Lembarek\Role\Repositories;

use Lembarek\Role\Models\Role;

class RoleRepository extends Repository implements RoleRepositoryInterface
{

    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

}
