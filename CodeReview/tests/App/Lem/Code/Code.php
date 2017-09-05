<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class CodeTest extends TestCase {

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

    }


    /**
    * @test
    * @dataProvider data_provider_for_it_execute_php_code
    */
    public function it_execute_php_code($code)
    {
        Code::execute($code);
    }


    public function data_provider_for_it_execute_php_code()
    {
        return[
            ['echo "hello";'],
        ];
    }


}
