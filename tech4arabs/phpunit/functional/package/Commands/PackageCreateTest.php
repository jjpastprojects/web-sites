<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PackageCreateTest extends TestCase {

    public function setUp()
    {
        parent::setUp();

        $this->vendor = 'joe';
        $this->name = 'package1';
        $this->email = 'joe@example.com';
        $this->author_name = 'joe doe';

        $this->path = getcwd()."/$this->vendor/$this->name";

        deleteDir($this->path);

    }


    /**
    * @test
    */
    public function it_create_new_package_providing_packageName_and_vendor()
    {
        Artisan::call('package:create',['--vendor' => $this->vendor, 'name' => $this->name]);

        $this->assertFileExists($this->path);

    }

    /**
    * @test
    */
    public function it_create_new_package_providing_just_package_name()
    {

        Artisan::call('package:create',['name' => $this->name]);

        $this->assertFileExists($this->path);

    }

   /**
    * @test
    */
    public function it_create_composer()
    {
        Artisan::call('package:create',['name' => $this->name]);
        $composer = $this->path.'/composer.json';
        $this->assertFileExists($composer);

       $this->assertJsonStringContainsJsonString($this->getComposerContenu(), file_get_contents($composer));

    }

    /**
    * @test
    */
    public function it_create_src_directory()
    {
        Artisan::call('package:create',['name' => $this->name]);

        $src = $this->path.'/src';

        $this->assertFileExists($src);

        $srcDirectoriesAndFiles = ['Controllers', 'Events', 'migrations', 'Models', 'Providers', 'Repositories', 'Requests', 'routes.php', 'views'];
        foreach($srcDirectoriesAndFiles as $f)
            $this->assertFileExists("$src/$f");

    }

    /**
    * @test
    */
    public function it_create_files_under_src()
    {

        Artisan::call('package:create',['name' => $this->name]);

        $files = [
            'Controllers/Controller.php',
            'Events/Event.php',
            'Models/Model.php',
            'Providers/ServiceProvider.php',
            'Repositories/Repository.php',
            'Requests/Request.php',
        ];
        foreach ($files as $file)
            $this->assertFileExists($this->path.'/src/'.$file);

    }

    /**
    * @test
    * @expectedException Symfony\Component\Console\Exception\RuntimeException
    * @expectedExceptionMessage Not enough arguments (missing: "name").
    */
    public function it_throw_an_exception_if_the_package_vendor_and_name_is_not_provived()
    {
        Artisan::call('package:create');
    }

    /**
    * @test
    * @expectedException Symfony\Component\Console\Exception\RuntimeException
    * @expectedExceptionMessage Not enough arguments (missing: "name").
    */
    public function it_throw_an_exception_if_the_package_name_is_not_provived()
    {
        Artisan::call('package:create');
    }

    protected function getComposerContenu()
    {
        return file_get_contents(__DIR__.'/../stubs/composer.json');
    }


}
