<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('guest.index');
});

Route::group(array('before' => 'auth'), function() {
	//Ketika user berhasil melakukan login maka user akan di arahkan ke halaman dashboard
	Route::get('dashboard', 'HomeController@dashboard');
	Route::group(array('prefix' => 'admin', 'before' => 'admin'), function() {
		Route::resource('authors', 'AuthorsController');
	});
});


//Jika tamu mengklik tombol login, maka tamu tersebut akan diarahkan ke halaman login
Route::get('login', array('guest.login', 'uses' => 'GuestController@login'));
//Melakukan post email dan password dari halaman login, jika berhasil diarahkan ke halaman dashboard
Route::post('authenticate', 'HomeController@authenticate');
//Jika user logout maka akan diarahkan ke function logout
Route::get('logout', 'HomeController@logout');

