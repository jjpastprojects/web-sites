<?php

namespace App\Repositories;

class JsonProductRepository implements ProductRepositoryInterface
{

  private $file = "products.json";

  /**
   * save a product to a json file
   *
   * @param  Array  $product
   * @return boolean
   */
  public function store($product)
  {
    $products = $this->getProducts();

    $products[] = $product;

    $this->saveProducts($products);
  }

  /**
   * get all products
   *
   * @param  string  $
   * @return Array
   */
  public function getProducts()
  {
    return json_decode(file_get_contents($this->file), true);
  }

  /**
   * save all products
   *
   * @param  Array  $products
   * @return boolean
   */
  public function saveProducts($products)
  {
    return file_put_contents($this->file, json_encode($products));
  }

  /**
   * get all products
   *
   * @return Json
   */
  public function all()
  {
    return $this->getProducts();
  }
}
