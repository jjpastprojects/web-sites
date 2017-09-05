<?php

namespace App\Repositories;

use App\Models\Question;

class QuestionRepository extends Repository
{

    protected $model;

    public function __construct(Question $model)
    {
        $this->model = $model;
    }



}
