<?php

namespace Lembarek\Blog\Repositories;

use Lembarek\Blog\Models\Category;
use Lembarek\Blog\Repositories\CategoryRepositoryInterface;

class CategoryRepository extends Repository implements CategoryRepositoryInterface
{

    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}
