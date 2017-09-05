<?php

 namespace Lembarek\ShareFiles\Repositories;

use Lembarek\Core\Repositories\Repository;
use Lembarek\ShareFiles\Models\File;

class FileRepository extends Repository implements FileRepositoryInterface
{
    protected $model;

    public function __construct(File $model)
    {
        $this->model = $model;
    }


    /**
     * search for files LIKE $q
     *
     * @param  string  $q
     * @return Array
     */
    public function search($q)
    {
        return $this->model->where('name', 'LIKE', "%$q%")->get()->toArray();
    }


    /**
     * get a file by slug
     *
     * @param  string $name
     * @return Site\File\Models\File
     */
    public function getFileBySlug($slug)
    {
        return $this->model->whereSlug($slug)->first();
    }
}
