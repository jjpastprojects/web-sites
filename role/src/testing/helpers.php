<?php

use Lembarek\Role\Models\Role;
use Lembarek\Role\Models\Permission;

function createRole($overs = [], $limit=1)
{
    return ufactory(Role::class, $limit)->create($overs);
}

function createPermission($overs = [])
{
    return ufactory(Permission::class)->create($overs);
}

function findOrCreateRole($overs = [])
{
    if($role = Role::where($overs)->first());
        return $role;
    return createRole($overs);
}

function  createUserWithRole($role)
{
    $role   = createRole(['name' => $role]);
    $user = createUser();
    $user->assignRole($role);
    return $user;
}


