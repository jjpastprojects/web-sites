<?php

namespace Lembarek\Blog\Controllers;

use Lembarek\Blog\Repositories\BlogRepository;
use Lembarek\Blog\Repositories\TagRepositoryInterface;
use Lembarek\Blog\Events\PostHasViewed;
use Lembarek\Blog\Repositories\PostRepositoryInterface;

class BlogsController extends Controller
{

    protected $blogRepo;

    protected $tagRepo;

    protected $postRepo;

    public function __construct(BlogRepository $blogRepo, TagRepositoryInterface $tagRepo, PostRepositoryInterface $postRepo)
    {
        $this->blogRepo = $blogRepo;
        $this->tagRepo = $tagRepo;
        $this->postRepo = $postRepo;
    }

    /**
     * show all blogs
     *
     * @return Response
     */
    public function posts()
    {
        $posts = $this->blogRepo->getPopular(10);
        return view('blog::blog.posts', compact('posts'));
    }

    /**
     * show a blogs
     *
     * @param  string  $slug
     * @return Response
     */
    public function show($slug)
    {
        $post =  $this->blogRepo->getBySlug($slug);

        event(new PostHasViewed($post));

        return view('blog::blog.show',compact('post'));
    }

    /**
     * show posts that have a tag
     *
     * @param  integer  $tag
     * @return Response
     */
    public function PostsWithTag($tag_name)
    {
        $posts = $this->tagRepo->findBy('name', $tag_name)->posts()->publishedBeforeNow()->get();

        return view('blog::blog.tags.posts', compact('posts'));
    }

    /**
     * show the page to search for posts
     *
     * @return Response
     */
    public function search()
    {
        return view('blog::blog.search');
    }

    /**
     * show recent posts
     *
     * @return Response
     */
    public function recent()
    {
        $posts = $this->postRepo->recents();
        return view('blog::blog.posts', compact('posts'));
    }

    /**
     * show popular posts
     *
     * @return Response
     */
    public function popular()
    {
        $posts = $this->postRepo->popular();
        return view('blog::blog.posts', compact('posts'));
    }

    /**
     * show the trending posts
     *
     * @return Response
     */
    public function trending()
    {
        $posts = $this->postRepo->trending();
        return view('blog::blog.posts', compact('posts'));
    }
}
