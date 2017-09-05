<?php

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * check if json file contain json string
     *
     * @param  string  $json1
     * @param  string  $json2
     * @return boolean
     */
    public function assertJsonStringContainsJsonString($json1, $json2)
    {
        $json1= json_decode($json1, true);
        $json2= json_decode($json2, true);
        return $this->assertArraySubset($json1, $json2);
    }
}
