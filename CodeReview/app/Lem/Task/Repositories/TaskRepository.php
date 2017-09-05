<?php namespace Lem\Task\Repositories;


/**
 * the repository for the Task Model
 **/
class TaskRepository
{
    protected $task;

    public function __construct()
    {
        $this->taskModel = new  \Lem\Task\Models\Task();
    }


    /**
     * create a new task
     *
     * @param  array  $columns
     * @return \Lem\Task\Models\Task
     */
    public function create($columns)
    {
       return  $this->taskModel->create($columns);
    }


    /**
     * get the tasks condition by the when condition
     *
     * @param  string  $whenCondition
     * @return array
     */
    public function getTasksByWhenCondition($whenCondition)
    {
        return $this->taskModel->where('whenCondition', '=',$whenCondition)->get();
    }


}
