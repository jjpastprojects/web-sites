<?php

namespace Lembarek\Role\Models;

use Lembarek\Role\Traits\Permissionable;

class Role extends Model
{
    use Permissionable;

    protected $fillable = ['name', 'order'];
}
