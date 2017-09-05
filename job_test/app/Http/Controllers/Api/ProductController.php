<?php namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepositoryInterface;

class ProductController extends Controller
{

  protected $productRepo;

  public function __construct(ProductRepositoryInterface $productRepo)
  {

    $this->productRepo = $productRepo;
  }

  /**
   * store a product
   *
   * @return void
   */
  public function store(ProductRequest $request)
  {
    return $this->productRepo->store($request->all());
  }

  /**
   * get all product
   *
   * @return Json
   */
  public function all()
  {
      return $this->productRepo->all();
  }

}
