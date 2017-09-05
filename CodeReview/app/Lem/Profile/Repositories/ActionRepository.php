<?php namespace Lem\Profile\Repositories;


use Lem\Profile\Interfaces\ActionInterface;
use Lem\Profile\Models\Action;

class ActionRepository implements ActionInterface
{

    /**
     * the action model
     *
     * @var Lem\Profile\Models\Action
     */
     protected $actionModel ;


    public function __construct()
    {
        $this->actionModel = new Action();
    }


}
