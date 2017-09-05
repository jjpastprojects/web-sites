<?php namespace Lem\Page\Repositories;


use Lem\Page\Interfaces\PageStatusInterface;
use Lem\Page\Models\PageStatus;

class PageStatusRepository implements PageStatusInterface
{

    /**
     * the PageStatus Model
     *
     * @var Lem\Page\Profile\Models\PageStatus
     */
     protected $pageStatusModel;


    public function __construct()
    {
        $this->pageStatusModel = new PageStatus();
    }


     /**
      * check if recored exists
      *
      * @param  integer  $user_id
      * @param  integer  $page_id
      * @param  array    $status
      * @return boolean
      */
     public function exists($user_id, $page_id, $status=[])
     {
         return count($this->pageStatusModel->where(array_merge(['user_id' => $user_id, 'page_id' => $page_id], $status))->get()) == 1;
     }


    /**
     * create a new recored
     *
     * @param  integer  $user_id
     * @return void
     */
    public function create($user_id, $page_id, $status=[])
    {
        return $this->pageStatusModel->create(array_merge(['user_id' => $user_id, 'page_id' => $page_id], $status));
    }


     /**
      * update a record
      *
      * @param  integer  $user_id
      * @return boolean
      */
     public function update($user_id, $page_id, $status=[])
     {
        return $this->pageStatusModel->whereUserId($user_id)->wherePageId($page_id)->update($status);
     }


}
