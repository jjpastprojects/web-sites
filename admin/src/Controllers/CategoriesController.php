<?php

namespace Lembarek\Admin\Controllers;

use App\Http\Requests;
use Lembarek\Blog\Repositories\CategoryRepositoryInterface;
use Lembarek\Admin\Requests\CreateCategoryRequest;
use Lembarek\Admin\Requests\UpdateCategoryRequest;

class CategoriesController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
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
        $categories = $this->categoryRepo->getPaginatedAndOrdered();
        return view('admin::categories.index', compact('categories', 'orderby', 'direction'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin::categories.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  Lembarek\Admin\Requests\CreateCategoryRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function store(CreateCategoryRequest $request)
    {
        $this->categoryRepo->create($request->all());
        return back()->with(['flash.message' => trans('admin::category.category_was_created', ['category' => $request->get('name')])]);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $category = $this->categoryRepo->find($id);
        return view('admin::categories.show', compact('category'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $category = $this->categoryRepo->find($id);
        return view('admin::categories.edit', compact('category'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->categoryRepo->find($id);
        $category->update($request->all());
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
        $this->categoryRepo->find($id)->delete();
        return back();
    }
}

