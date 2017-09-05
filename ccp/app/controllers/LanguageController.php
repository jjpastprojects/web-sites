<?php


class LanguageController extends BaseController {
		public function chooser(){
			Session::set('locale', Input::get('locale'));
			return Redirect::back();
		}
}
