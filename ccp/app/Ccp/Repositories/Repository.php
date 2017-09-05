<?php namespace Ccp\Repositories;

abstract class Repository
{
    /**
     * get all
     *
     * @return void
     */
    public function all()
    {
        $this->model->all();
    }


    /**
     * create a new record
     *
     * @param  array  $input
     * @return Models
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

}
