<?php

	class Questions_Controller extends Base_Controller {

		public $restful = true;

		public function get_index(){
			return View::make('questions.index')
				->with('title','Make It Snappy Q&A - Home');
		}
	}
	
