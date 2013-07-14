<?php

	class Users_Controller extends Base_Controller{

		public $restful = true;

		public function get_new(){
			return View::make('users.new')
				->with('title','Make It Snappy Q&A - Register');
		}

		public function post_create(){
			$validation = User::validate(Input::all());

			if ($validation->passes()){
				User::create(array(
					'username'=>Input::get('username'),
					'password'=>Hash::make(Input::get('password'))
					));

				$user = User::where_username(Input::get('username'))->first();
				Auth::login($user);

				return Redirect::to_route('home')
					->with('message','Thanks for registering. You are now logged in.');

			} else {
				return Redirect::to_route('register')->with_errors($validation)->with_input();
			}
		}

		public function get_login(){
			return View::make('users.login')
				->with('title','Make It Snappy Q&A - Login');
		}

		public function post_login(){
			$user = array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
			);

			if (Auth::attempt($user)){
				return Redirect::to_route('home')->with('message','You are logged in.');
			} else {
				return Redirect::to_route('login')
					->with('message','Your username/password combination is incorrect')
					->with_input();
			}
		}

		public function get_logout(){
			if(Auth::check()){
				Auth::logout();
				return Redirect::to_route('login')->with('message','You are now logged out.');
			} else {
				return Redirect::to_route('home');
			}
		}
	}