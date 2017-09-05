<?php

class LearnController extends BaseController{
		function angular(){
			return View::make('learn.angular');
		}	
		function todos(){
			return Todo::all();
		}
		public function add2()
		{
			Todo::create([
					'body' => Input::get('body'),
					'completed' => 0,
				]);
		}
}