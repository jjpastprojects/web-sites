<?php

namespace Testing\Integration\Controllers\Api;

use TestCase;


class ProductControllerTest extends TestCase {

    public function setUp()
    {
      parent::setUp();
    }

    /**
    * @test
    */
    public function it_save_product()
    {
        $this->post(route('product.store'), ['name' => 'product1', 'quantity' => 1, 'price' => 2]);
        $this->post(route('product.store'), ['name' => 'product2', 'quantity' => 1, 'price' => 2]);
    }
}
