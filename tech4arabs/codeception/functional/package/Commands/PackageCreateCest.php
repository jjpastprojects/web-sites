<?php

use PHPUnit_Framework_TestCase as ph;

class PackageCreateCest
{

    public function _before(FunctionalTester $I)
    {
        $this->vendor = 'joe';
        $this->name = 'package1';
        $this->email = 'joe@example.com';
        $this->author_name = 'joe doe';

        $this->path = getcwd()."/$this->vendor/$this->name";

        deleteDir(getcwd()."/$this->vendor");

    }


    public function _after(FunctionalTester $I)
    {
    }


    public function it_create_new_package_providing_packageName_and_vendor(FunctionalTester $I)
    {
        Artisan::call('package:create',['--vendor' => $this->vendor, 'name' => $this->name]);

        ph::assertFileExists($this->path);

    }


    public function it_create_new_package_providing_just_package_name(FunctionalTester $I)
    {

        Artisan::call('package:create',['name' => $this->name]);

        ph::assertFileExists($this->path);

    }


/*    public function it_create_composer(FunctionalTester $I)*/
    //{
        //Artisan::call('package:create',['name' => $this->name]);
        //$composer = $this->path.'/composer.json';
        //ph::assertFileExists($composer);

        //$I->assertJsonStringContainsJsonString($this->getComposerContenu(), file_get_contents($composer));

    //}


    public function it_create_src_directory(FunctionalTester $I)
    {
        Artisan::call('package:create',['name' => $this->name]);

        $src = $this->path.'/src';

        ph::assertFileExists($src);

        $srcDirectoriesAndFiles = ['Controllers', 'Events', 'migrations', 'Models', 'Providers', 'Repositories', 'Requests', 'routes.php', 'views'];
        foreach($srcDirectoriesAndFiles as $f)
            ph::assertFileExists("$src/$f");

    }


    public function it_create_files_under_src(FunctionalTester $I)
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
            ph::assertFileExists($this->path.'/src/'.$file);

    }


    public function it_throw_an_exception_if_the_package_vendor_and_name_is_not_provited(FunctionalTester $I)
    {
        $I->assertTrue(
            $I->seeExceptionThrown('Symfony\Component\Console\Exception\RuntimeException', function() use($I){
                Artisan::call('package:create');
            }));

    }


    public function it_check_that_the_git_directory_exists(FunctionalTester $I)
    {
        Artisan::call('package:create',['name' => $this->name]);

        ph::assertFileExists("$this->path/.git");
    }


    protected function getComposerContenu()
    {
        return file_get_contents(__DIR__.'/../stubs/composer.json');
    }


     public function it_check_that_the_new_directory_it_simular_to_stubs(FunctionalTester $I)
     {
         Artisan::call('package:create',['name' => $this->name]);

         $stubsDir = __DIR__.'/../stubs';
         $files = get_subdir_files($stubsDir);

         $files2 = get_subdir_files($this->path);

         foreach($files as $key  => $file1){
             $file2 = $files2[$key];
             ph::assertEquals(file_get_contents($file1), file_get_contents($file2));
         }

         $dirs = get_subdir_dirs($stubsDir);
         $dirs2 = get_subdir_dirs($this->path);
         foreach ($dirs as $key =>  $dir) {
             $dir2 = $dirs2[$key];
             $dir2 = str_replace($this->path, '', $dir2);
             $dir = str_replace($stubsDir, '', $dir);
             ph::assertEquals($dir, $dir2);
         }
     }
}
