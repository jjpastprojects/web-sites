<?php

namespace App\Repositories;

use App\Models\Answer;

class AnswerRepository extends Repository
{

    protected $model;

    public function __construct(Answer $model)
    {
        $this->model = $model;
    }

}
