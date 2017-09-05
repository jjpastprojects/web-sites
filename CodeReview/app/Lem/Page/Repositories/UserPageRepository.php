<?php namespace Lem\Page\Repositories;


use Lem\Page\Interfaces\UserPageInterface;
use Lem\Page\Models\UserPage;

class UserPageRepository implements UserPageInterface
{

    /**
     * the UserPage Model
     *
     * @var Lem\Page\Profile\Models\UserPage
     */
     protected $userPageModel;


    public function __construct()
    {
        $this->userPageModel = new UserPage();
    }


     /**
      * create a record
      *
      * @param  integer  $user_id
      * @param  integer  $page_id
      * @param  integer  $score
      * @return mixed
      */
     public function create($user_id, $page_id, $score)
     {
         return $this->userPageModel->create(['user_id' => $user_id, 'page_id' => $page_id, 'score' => $score]);
     }


     /**
      * chek if some record exist in database
      *
      * @param  integer  $user_id
      * @return boolean
      */
     public function exists($user_id, $page_id)
     {
         return count($this->userPageModel->whereUserId($user_id)->wherePageId($page_id)) == 1;
     }


     /**
      * update score
      *
      * @param  integer  $user_id
      * @return \Lem\Page\Models\UserPage
      */
     public function updateScore($user_id, $page_id, $score)
     {
         return $this->userPageModel->whereUserId($user_id)->wherePageId($page_id)->update(['score' => $score]);
     }


     /**
      * get pages for a user
      *
      * @param  integer  $user_id
      * @return array
      */
     public function getAllPagesForUser($user_id)
     {
         return array_divide(array_dot($this->userPageModel->whereUserId($user_id)->orderBy('score')->get(['page_id'])->toArray()))[1];
     }


     /**
      * check if page has status
      *
      * @param  integer  $user_id
      * @param  integer  $page_id
      * @param  array    $status
      * @return boolean
      */
     public function haveStatus($user_id, $page_id, $status=[])
     {
         $page = $this->userPageModel->where('user_id', '=', $user_id)->where('page_id', '=', $page_id);
          foreach ($status as $key => $value) {
                $page = $page->where($key, '=', $value);
          }
          $page = $page->get();
          return count($page) == 1;
     }


     /**
      * set a status
      *
      * @param  integer  $user_id
      * @param  integer   $page_id
      * @param  array     $statuses
      * @return Lem\Page\Models\UserPage
      */
     public function setStatus($user_id, $page_id, $statuses=[])
     {
         $userPage = $this->userPageModel->whereUserId($user_id)->wherePageId($page_id);
         $userPage->update($statuses);
         return $userPage;
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
