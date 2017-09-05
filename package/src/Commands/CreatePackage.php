<?php

namespace Lembarek\Package\Commands;

use Lembarek\Package\Package\PackageInterface;

class CreatePackage extends Command
{

    protected $package;

    public function __construct(PackageInterface  $package)
    {
        parent::__construct();
        $this->package = $package;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:create  {name} {--description=} {--vendor=}  {--author_email} {--author_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to facilate the creation of laravel package';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        extract($this->getOptions());

        $this->package->setAll($vendor, $name, $author_email, $author_name)->create();
    }

    /**
     * return options value
     *
     * @param  string  $option
     * @return string
     */
    private function getOption($option)
    {
        $option = $this->option($option)?:config("package.$option");
        return $option;
    }

    /**
     * get all options
     *
     * @return array
     */
    public function getOptions()
    {
        $options = ['vendor', 'author_email', 'author_name', 'description'];

        foreach ($options as $option) {
            $optionsValues[$option] = $this->getOption($option);
        }

        return $optionsValues;
    }
}
