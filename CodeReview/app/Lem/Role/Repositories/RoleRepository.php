<?php namespace Lem\Role\Repositories;


use Lem\Role\Interfaces\RoleInterface;
use Lem\Role\Models\Role;

class RoleRepository implements RoleInterface
{


    /**
     * the Role Model
     *
     * @var Lem\Profile\Models\Role
     */
     protected $roleModel;


    public function __construct()
    {
        $this->roleModel = new Role();
    }


}
