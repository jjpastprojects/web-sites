<?php namespace App\Http\Controllers;

use App\Facades\User;
use App\Facades\Page;
use Illuminate\Http\Request;

class PageController extends Controller {

        public function __construct()
        {
	    $this->middleware('auth');
            if(\Auth::check())
                $this->current_user_id = \Auth::user()->id;
            else $this->current_user_id = -1;
        }


        /**
         * get all pages
         *
         * @return void
         */
        public function get(Request $request)
        {
            $status = [];

            if(!is_null($request->get('isReaded')) )
                if(in_array($request->get('isReaded'), [1, 'true']))
                    $status['isReaded'] = true;
                else
                    $status['isReaded'] = false;


            if(!is_null($request->get('isSaved')) )
                if(in_array($request->get('isSaved'), [1, 'true']))
                    $status['isSaved'] = true;
                else
                    $status['isSaved'] = false;

            if(!is_null($request->get('inTrash')) )
                if(in_array($request->get('inTrash'), [1, 'true']))
                    $status['inTrash'] = true;
                else
                    $status['inTrash'] = false;

            if(count($status) == 0) {
                $status['isReaded']=false;
                $status['inTrash'] = false;
                $status['isSaved'] = false;
            }


            $pages = User::pages($this->current_user_id,['title'], $status);
            if(count($pages) == 0) {
                return view('page.no_pages');
            }
            return view('page.index')->with('pages', $pages);
        }


        /**
         * show a page
         *
         *
         * @param string $title
         * @return void
         */
        public function show($title)
        {
            $page = Page::getPagesWhere(['title' => $title])->first();

            if(count($page) == 1){
                $page_id = $page->toArray()['id'];
                Page::setStatus($this->current_user_id, $page_id, ['isReaded' => true]);
                return view('page.show')->with('page', $page);
            }
        }


        /**
         * save a a page
         *
         * @return boolean
         */
        public function save(Request $request)
        {
            $title = $request->get('title');
            $page_id = Page::getPagesWhere(['title' => $title])->first()->id;
            Page::setStatus($this->current_user_id, $page_id, ['isSaved' => true]);
        }


        /**
         * delete a a page
         *
         * @return boolean
         */
        public function delete(Request $request)
        {
            $title = $request->get('title');
            $page_id = Page::getPagesWhere(['title' => $title])->first()->id;
            Page::setStatus($this->current_user_id, $page_id, ['inTrash' => true]);
        }


}
