<?php

namespace Lembarek\Blog\Controllers;
use Lembarek\Blog\Repositories\PopularityRepositoryInterface;

class PopularityController extends Controller
{

    protected $popularityRepo;

    public function __construct(PopularityRepositoryInterface $popularityRepo)
    {
        $this->popularityRepo = $popularityRepo;
    }

    /**
     * add popularity to post
     *
     * @param  integer  $post_id
     * @param  integer  $factor_id
     * @return JSON
     */
    public function add($post_id, $factor_id)
    {
        $new_popularity = $this->popularityRepo->add($post_id, $factor_id);
        return $new_popularity;
    }

}
