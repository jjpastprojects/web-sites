<?php

namespace Lembarek\Admin\Controllers;

use Lembarek\Admin\Requests\CreateCategoryPostRequest;
use Lembarek\Admin\Requests\DestroyCategoryPostRequest;
use Lembarek\Blog\Repositories\PostRepositoryInterface;
use Lembarek\Blog\Repositories\CategoryRepositoryInterface;

class CategoryPostController extends Controller
{
    protected $postRepo;

    protected $categoryRepo;

    public function __construct(PostRepositoryInterface $postRepo, CategoryRepositoryInterface $categoryRepo)
    {
        $this->postRepo = $postRepo;
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * attach post to a category
     *
     * @param  string  $
     * @return Response
     */
    public function store(CreateCategoryPostRequest $request)
    {
        $post = $this->postRepo->find($request->get('post_id'));
        $category = $this->categoryRepo->find($request->get('category_id'));

        $post->addToCategory($category);

        return back();
    }

    /**
     * detach post from category
     *
     * @return Response
     */
    public function destroy(DestroyCategoryPostRequest $request)
    {
        $post = $this->postRepo->find($request->get('post_id'));
        $category = $this->categoryRepo->find($request->get('category_id'));

        $post->deleteFromCategory($category);

        return back();
    }
}
