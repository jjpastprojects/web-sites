<?php

namespace Lembarek\Admin\Controllers;

use App\Http\Requests;
use Lembarek\Admin\Requests\CreatePostRequest;
use Lembarek\Admin\Requests\UpdatePostRequest;
use Lembarek\Blog\Repositories\PostRepositoryInterface;
use Illuminate\Contracts\Auth\Access\Gate;

class PostsController extends Controller
{
    protected $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {

        $this->postRepo = $postRepo;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $direction = request()->get('direction');
        $orderby = request()->get('orderby');

        $posts = $this->postRepo->getPaginatedAndOrdered();
        return view('admin::posts.index', compact('posts', 'direction', 'orderby'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin::posts.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  CreatePostRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function store(CreatePostRequest $request, Gate $gate)
    {
        if($gate->allows('create-posts')){
                $post = $this->postRepo->create($request->except('_token', 'reladed_posts'));
                $this->add_related_posts($post, $request->get('related_posts'));
                return redirect(route('admin::posts.index'))->with(['flash.message' => trans('admin::posts.post_created')]);
        }else{
            return redirect(route('admin::posts.index'))->with(['flash.message' => trans('admin::posts.can_not_create_post')]);
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  string $slug
    * @return \Illuminate\Http\Response
    */
    public function show($slug)
    {
        $post = $this->postRepo->findBy('slug', $slug);
        return view('blog::blog.show', ['post' => $post]);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $post = $this->postRepo->find($id);
        return view('admin::posts.edit', compact('post'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  UpdatePostRequest  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(UpdatePostRequest $request, $id, Gate $gate)
    {
        if($gate->allows('edit-posts')){
            $post = $this->postRepo->find($id);
            $this->add_related_posts($post, $request->get('related_posts'));
            $post->update($request->except('_method', '_token', 'related_posts'));
            return back()->with('flash.message', 'admin::posts.posts_updated');
        }else{
            return back()->with('flash.message', 'admin::posts.can_not_update_posts');
        }

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id, Gate $gate)
    {
        if($gate->allows('destroy-posts')){
            $post = $this->postRepo->find($id);
            $post->delete();
            return redirect(route('admin::posts.index'))->with('flash.message', trans('admin::posts.post_deleted'));;
        }
    }

    /**
     * add related posts
     *
     * @param Post     $post
     * @param  string  $posts
     * @return void
     */
    public function add_related_posts($post, $posts)
    {
        $posts_ids = explode(';', $posts);
        $posts_ids = array_map(function($id){
          return (int)$id;
        }, $posts_ids);
        $post->relateds()->sync($posts_ids);
    }
}
