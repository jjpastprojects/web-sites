<?php namespace Lem\Page;


use App\Facades\Code;
use App\Facades\User;

/**
 * to manipilate the pages
 **/
class Page
{

    function __construct()
    {
        $this->pageRepo = new \Lem\Page\Repositories\PageRepository();
        $this->userPageRepo = new \Lem\Page\Repositories\UserPageRepository();
        $this->pageStatusRepo = new \Lem\Page\Repositories\PageStatusRepository();
    }


    /**
     * to calcule score and save it to tables
     *
     * @param  integer  $user_id
     * @param  integer  $page_id
     * @return mixed
     */
    public function evalCode($user_id, $page_id)
    {
        $code = $this->pageRepo->get('code', $page_id);
        Code::execute($code, ['current_user_id' => $user_id, 'current_page_id' => $page_id]);
    }


    /**
     * eval code for specefic user
     *
     * @param  integer  $user_id
     * @return mixed
     */
    public function evalCodeForUser($user_id)
    {
        $pages_id = $this->pageRepo->getAllIds();
        foreach ($pages_id as $page_id) {
            $this->evalCode($user_id, $page_id);
        }
    }


    /**
     * eval codef for a specefic page
     *
     * @param  integer  $page_id
     * @return mixed
     */
    public function evalcodeForPage($page_id)
    {
        $users_id = User::getAllIds();
        foreach ($users_id as $user_id) {
            $this->evalCode($user_id, $page_id);
        }
    }


    /**
     * to calcule score and save it to tables
     *
     * @param  integer  $user_id
     * @param  integer  $page_id
     * @param  integer  $score
     * @return mixed
     */
    public function saveScore($user_id, $page_id, $score)
    {
        if($this->userPageRepo->exists($user_id, $page_id))
            return $this->userPageRepo->updateScore($user_id, $page_id, $score);
        return $this->userPageRepo->create($user_id, $page_id, $score);
    }


    /**
     * get all pages for a user
     *
     * @param  integer  $user_id
     * @return array
     */
    public function getAllPagesForUser($user_id)
    {
        return $this->userPageRepo->getAllPagesForUser($user_id);
    }


    /**
     * transform title to url
     *
     * @param  string  $title
     * @return string
     */
    public function titleToUrl($title)
    {
        return "/page/".$title;
    }


    /**
     * get a pages
     *
     * @param  array  $columns
     * @return array
     */
    public function getPagesWhere($columns = [])
    {
       return $this->pageRepo->getWhere($columns);
    }


    /**
     * decode html code
     *
     * @param  string  $code
     * @return string
     */
    public function decode($code)
    {
        return html_entity_decode($code);
    }


    /**
     * set Status to a page
     *
     * @param  integer  $user_id
     * @param  integer  $page_id
     * $param  string   $statuses
     * @return Lem\Page\Models\UserPage
     */
    public function setStatus($user_id, $page_id, $statuses = [])
    {
        return $this->userPageRepo->setStatus($user_id, $page_id, $statuses);
    }


    /**
     * check if page is have status
     *
     * @param  integer  $user_id
     * @return boolean
     */
    public function haveStatus($user_id, $page_id, $status=[])
    {
        return $this->userPageRepo->haveStatus($user_id, $page_id, $status);
    }

    /**
      * check if page readed
      *
      * @param  integer  $user_id
      * @param  integer  $page_id
      * @return boolean
      */
     public function isReaded($user_id, $page_id)
     {
         return $this->haveStatus($user_id, $page_id, ['isReaded' => true]);
     }

}
