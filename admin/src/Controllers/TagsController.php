<?php

namespace Lembarek\Admin\Controllers;

use App\Http\Requests;
use Lembarek\Blog\Repositories\TagRepositoryInterface;
use Lembarek\Admin\Requests\CreateTagRequest;
use Lembarek\Admin\Requests\UpdateTagRequest;

class TagsController extends Controller
{
    protected $tagRepo;

    public function __construct(TagRepositoryInterface $tagRepo)
    {
        $this->tagRepo = $tagRepo;
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
        $tags = $this->tagRepo->getPaginatedAndOrdered();
        return view('admin::tags.index', compact('tags', 'orderby', 'direction'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin::tags.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  Lembarek\Admin\Requests\CreateTagRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function store(CreateTagRequest $request)
    {
        $this->tagRepo->create($request->all());
        return back()->with(['flash.message' => trans('admin::tag.tag_was_created', ['tag' => $request->get('name')])]);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $tag = $this->tagRepo->find($id);
        return view('admin::tags.show', compact('tag'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $tag = $this->tagRepo->find($id);
        return view('admin::tags.edit', compact('tag'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateTagRequest $request, $id)
    {
        $tag = $this->tagRepo->find($id);
        $tag->update($request->all());
        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $this->tagRepo->find($id)->delete();
        return "success";
    }
}

