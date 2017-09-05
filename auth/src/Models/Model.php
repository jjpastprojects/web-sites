<?php

namespace Lembarek\Auth\Models;

use Lembarek\Core\Models\Model as MainModel;

abstract class Model extends MainModel
{
    protected $table = 'password_resets';

    protected $fillable = ['email', 'token'];
}
