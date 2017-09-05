<?php

namespace Lembarek\Blog\Repositories;

use Lembarek\Blog\Models\Post;

class BlogRepository extends Repository implements BlogRepositoryInterface
{

    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * get popular pages
     *
     * @param  integer  $limit
     * @return Blog
     */
    public function getPopular($limit=20)
    {
        return $this->model->latest()->whereActive(1)->publishedBeforeNow()->limit($limit)->get();
    }

}
