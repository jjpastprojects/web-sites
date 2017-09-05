<?php namespace Lem\Task;


use App\Facades\Code;
use Auth;
use Lem\Task\Exception\TaskException;
use Lem\Task\Repositories\TaskRepository;
use Lem\Task\Models\Task as TaskModel;
use App\Facades\Condition;
use App\Facades\Action;


/**
* to execute tasks
**/
class Task
{

    protected   $taskRepo ;

    public function __construct(TaskRepository $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }


    /**
     * execute the tasks
     *
     * @param  string  $whenCondition
     * @param array    @variables
     * @return void
     */
    public   function execute($whenCondition)
    {
        $tasks = $this->taskRepo->getTasksBywhenCondition($whenCondition);
        foreach($tasks as $task){
                Code::execute($task->code);
            }
    }


    /**
     * create a new task
     *
     * @param  array  $columns
     * @return \Lem\Task\Models\Task
     */
    public function createTask($columns)
    {
        return $this->taskRepo->create($columns);
    }


}
