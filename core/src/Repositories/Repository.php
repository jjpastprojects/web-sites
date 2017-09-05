<?php

 namespace Lembarek\Core\Repositories;

abstract class Repository
{
    /**
     * create a new record
     *
     * @param  array  $input
     * @return Models
     */
    public function create($inputs)
    {
        $record = $this->model->create($inputs);
        $record->save();
        return $record;
    }

    /**
     * get all records in database
     *
     * @param  integer  $limit
     * @return Model
     */
    public function all($limit = null)
    {
        if($limit){
            return $this->model->limit($limit)->get();
        }

        return $this->model->all();
    }

    /**
     * get all records in database with withs
     *
     * @param  string   $with
     * @param  integer  $limit
     * @return void
     */
    public function allWith($with, $limit = null)
    {
        if ($limit) {
            return $this->model->with($with)->limit($limit)->get();
        }

        return $this->model->with($with)->get();

    }

    /**
     * get the columns for a users
     *
     * @param  int  $user
     * @return Model
     */
    public function getForUser($user_id = null)
    {
        if ($user_id) {
            return $this->model->whereUserId($user_id)->get()->first()->toArray();
        }

        if(auth()->user()){
            return $this->model->whereUserId(auth()->user()->id)->first()->toArray();
        }


        return null;
    }

    /**
     * try to simulate the where of Eloquent
     *
     * @param  string  $key
     * @param  string  $value
     * @return this
     */
    public function where($key, $value=null)
    {
        if($value)
            return $this->model->where($key, $value);
        if(is_array($key))
            return $this->model->where($key);
        return null;
    }

    /**
     * get by slug
     *
     * @param  string  $slug
     * @return Model
     */
    public function getBySlug($slug)
    {
       return $this->model->where('slug', $slug)->first();
    }

    /**
     * get model
     *
     * @return Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * find a first record
     *
     * @param  integer  $id
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * find the first record by
     *
     * @param  string  $by
     * @param  mix   $value
     * @return Model
     */
    public function findBy($by, $value)
    {
        return $this->where($by, $value)->first();
    }

    /**
     * return paginate
     *
     * @param  integer $paginate
     * @return Model
     */
    public function paginate($paginate = null)
    {
        $p = $paginate? : config('admin.paginate');

        return $this->model->paginate($p);
    }

    /**
     * orderBy
     *
     * @param  string  $orderby
     * @return Model
     */
    public function orderBy($orderBy, $direction='asc')
    {
        if($direction == 'desc')
            return $this->model->orderBy($orderBy, 'desc');
        else
            return $this->model->orderBy($orderBy, 'asc');
    }

    /**
     * get a record paginated and ordered
     *
     * @return Model
     */
    public function getPaginatedAndOrdered()
    {
        $direction = request()->get('direction');
        $orderBy = request()->get('orderby');

        $p = config('admin.paginate');

        if($orderBy)
            return $this->orderBy($orderBy, $direction)->paginate($p);
        return $this->paginate();
    }

    /**
     * get recents
     *
     * @param  integer  $limit
     * @return Post
     */
    public function recents($limit=20)
    {
        return $this->model->orderBy('created_at', 'DESC')->limit($limit)->get();
    }

     /**
      * update the status of the model
      *
      * @param  integer  $id
      * @param  string   $key
      * @param  string   $value
      * @return Model
      */
     public function update($id, $key, $value=null)
     {
         $model =  $this->model->find($id);

         if (is_array($key))
             $model->update($key);
         else
             $model->{$key}= $value;

         $model->save();
     }

    /**
     * first or create the model
     *
     * @param  array  $inputs
     * @return Model
     */
    public function firstOrCreate($inputs)
    {
        return $this->model->firstOrCreate($inputs);
    }


}
