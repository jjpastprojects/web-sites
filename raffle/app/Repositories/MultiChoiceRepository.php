<?php

namespace App\Repositories;

use App\Models\MultiChoice;

class MultiChoiceRepository extends Repository
{

    protected $model;

    public function __construct(MultiChoice $model)
    {
        $this->model = $model;
    }

}
