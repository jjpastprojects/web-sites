<?php namespace Lem\Page\Repositories;


use Lem\Page\Interfaces\PageInterface;
use Lem\Page\Models\Page;

class PageRepository implements PageInterface
{

    /**
     * the Page Model
     *
     * @var Lem\Page\Profile\Models\Page
     */
     protected $pageModel;


    public function __construct()
    {
        $this->pageModel = new Page();
    }


     /**
      * get a specific column
      *
      * @param  string  $column
      * @return string
      */
     public function get($column, $page_id)
     {
         return $this->pageModel->findOrFail($page_id)->get([$column])->toArray()[0]['code'];
     }


     /**
      * get ids for all pages
      *
      * @param  string  $
      * @return array
      */
     public function getAllIds()
     {
         return array_divide(array_dot($this->pageModel->get(['id'])->toArray()))[1];
     }


     /**
      * get where
      *
      * @param  array  $columns
      * @return array
      */
     public function getWhere($columns = [])
     {
        $pages = $this->pageModel;
        foreach ($columns as $key => $value) {
            $pages = $pages->where($key , '=', $value);
        }
         return $pages->get();
     }


}
