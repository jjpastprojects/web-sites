<?php

namespace Lembarek\Package\Package;

use Illuminate\Filesystem\Filesystem;

class Package implements PackageInterface
{

    protected $vendor;

    protected $name;

    protected $author_email;

    protected $author_name;

    protected $path;

    public function __construct(Filesystem $fs, $vendor = '', $name = '', $author_email = '', $author_name = '')
    {
        $this->fs = $fs;
        $this->setAll($vendor, $name, $author_email, $author_name);
    }


    /**
     * set all locals variables
     *
     * @param  string  $vendor
     * @param  string  $name
     * @param  string  $author_email
     * @param  string  $author_name
     * @return void
     */
    public function setAll($vendor, $name, $author_email, $author_name, $path="")
    {
        $this->vendor = $vendor;
        $this->name = $name;
        $this->author_email = $author_email;
        $this->author_name = $author_name;
        if($path) $this->path = $path.'/'.$this->vendor.'/'.$this->name;
        else $this->path = getcwd().'/'.$this->vendor.'/'.$this->name;
        $this->composer = "$this->path/composer.json";

        return $this;
    }


    /**
     * create a new package
     *
     * @return void
     */
    public function create()
    {

        $this->fs->makeDirectory($this->path, '0755', True);

        $this->createSrc();

        $this->replaceAllInFiles(get_subdir_files($this->path));

        $this->createServiceProvider();

        initGit($this->path);

    }


    /**
     * create the src directory with its directories and files
     *
     * @return void
     */
    private function createSrc()
    {
        $src = "$this->path/src";

        $this->fs->makeDirectory($src);

        recurse_copy(__DIR__."/../templates/*",  $this->path);
    }


    /**
     * replace variables with its values in all files
     *
     * @param  array  $files
     * @return void
     */
    private function replaceAllInFiles($files)
    {
        foreach ($files as $file) {
            $this->replaceAllInFile($file);
        }
    }


    /**
     * create the service provider
     *
     * @return void
     */
    private function createServiceProvider()
    {
        $file = __DIR__.'/../files/ServiceProvider.php';
        $new_file = $this->path.'/src/Providers/'.ucfirst($this->name).'ServiceProvider.php';
        replaceAndSave($file, 'now_string', 'now_string', $new_file);
        $this->replaceAllInFile($new_file);
    }


    /**
     * replace variables with they values
     *
     * @param  string  $file
     * @return void
     */
    private function replaceAllInFile($file, $new_file=null)
    {
        replaceAndSave($file, '{{name}}', $this->name);
        replaceAndSave($file, '{{vendor}}', $this->vendor);
        replaceAndSave($file, '{{Name}}', ucfirst($this->name));
        replaceAndSave($file, '{{Vendor}}', ucfirst($this->vendor));
        replaceAndSave($file, '{{author_name}}', $this->author_name);
        replaceAndSave($file, '{{author_email}}', $this->author_email, $new_file);
    }
}
