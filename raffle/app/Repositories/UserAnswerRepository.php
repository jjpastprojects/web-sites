<?php

namespace App\Repositories;

use App\Models\UserAnswer;

class UserAnswerRepository extends Repository
{

    protected $model;

    public function __construct(UserAnswer $model)
    {
        $this->model = $model;
    }

}
