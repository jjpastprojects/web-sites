<?php

use Lembarek\Role\Models\Role;
use Lembarek\Auth\Models\User;
use Lembarek\ShareFiles\Models\File;
use Lembarek\Profile\Models\Profile;

function createUser($overs = [])
{
    return factory(User::class)->create($overs);
}

function createFile($overs = [])
{
    return factory(File::class)->create($overs);
}

function  createProfile($overs = [])
{
    return factory(Profile::class)->create($overs);
}

 function  createUserWithRole($role)
{
    $role = Role::whereName($role)->first();
    $user = createUser();
    $user->assignRole($role);
    return $user;
}



