<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	protected $layout = 'layouts.master';

	public function dashboard()
	{
		$this->layout->content = View::make('dashboard.index')->withTitle('Dashboard');
	}


	//Function untuk melakukan autentikasi user yang telah terdaftar ke dalam database.
	public function authenticate()
	{
		$credentials = array(
			'email'		=> Input::get('email'),
			'password'	=> Input::get('password'),
		);

		try
		{
			//Authentikasi user
			$user = Sentry::authenticate($credentials, false);

			//Jika berhasil redirect user ke dashboard
			return Redirect::intended('dashboard');
		} catch(Cartalyst\Sentry\Users\WrongPasswordException $e){
			//
			return Redirect::back()->with('errorMessage', 'Password yang anda masukan salah.');
		} catch (Exception $e) {
			return Redirect::back()->with('errorMessage', trans('Akun dengan email tersebut tidak ditemukan di sistem kami.'));
		}
	}

	public function logout()
	{
		//Logout user
		Sentry::logout();
		//Redirect user ke halaman login
		return Redirect::to('login')->with('successMessage', 'Anda berhasil logout.');
	}

}
