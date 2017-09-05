<?php

namespace Lembarek\Blog\Repositories;

use Lembarek\Blog\Models\Tag;
use Lembarek\Blog\Repositories\TagRepositoryInterface;

class TagRepository extends Repository implements TagRepositoryInterface
{

    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }
}
