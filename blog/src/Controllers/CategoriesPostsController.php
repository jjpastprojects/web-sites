<?php

namespace Lembarek\Blog\Controllers;

use Lembarek\Blog\Repositories\CategoryRepositoryInterface;

class CategoriesPostsController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * it show categories page
     *
     * @return Response
     */
    public function index()
    {
        return view('blog::categories.index');
    }

    /**
     * show posts connect to this category
     *
     * @param  Category  $category
     * @return Response
     */
    public function posts($category)
    {
        $posts = $this->categoryRepo->findBy('name', $category)->posts;
        return view('blog::categories.posts', compact('posts'));
    }
}
