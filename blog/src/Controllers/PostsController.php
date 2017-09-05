<?php

namespace Lembarek\Blog\Controllers;
use Lembarek\Blog\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostsController extends Controller
{


    protected $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    /**
     * get simular posts
     *
     * @param  string  $post
     * @return JSON
     */
    public function get_posts($post, Request $request)
    {
        $limit = $request->get('limit', 20);
        return $this->postRepo->get_simular_posts($post, $limit);
    }

}
