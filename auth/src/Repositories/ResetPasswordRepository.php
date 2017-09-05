<?php

namespace Lembarek\Auth\Repositories;

use Lembarek\Auth\Models\ResetPassword;

class ResetPasswordRepository extends Repository implements ResetPasswordRepositoryInterface
{

    protected $model;

    public function __construct(ResetPassword $model)
    {
    $this->model = $model;
    }

}
