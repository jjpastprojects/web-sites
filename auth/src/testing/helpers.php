<?php

use App\Models\User;

function createUser($overs = [], $limit=1)
{
    return ufactory(User::class, $limit)->create($overs);
}

function makeUser($overs = [])
{
    return ufactory(User::class)->make($overs);
}

function createAdmin($overs = [])
{
    $adminRole = findOrCreateRole(['name' => 'admin', 'order' => 2]);

    $admin =  createUser($overs);

    $admin->assignRole($adminRole);

    return $admin;
}

function login($user)
{
    return Auth::loginUsingId($user->id);
}

function logout($user)
{
    return Auth::logout($user);
}

