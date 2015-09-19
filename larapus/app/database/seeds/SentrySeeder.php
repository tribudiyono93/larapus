<?php
/**
* 
*/
class SentrySeeder extends Seeder
{
	
	public function run()
	{

		DB::table('users_groups')->delete();
		DB::table('groups')->delete();
		DB::table('users')->delete();
		DB::table('throttle')->delete();

		try
		{
			//Membuat group admin
			$group = Sentry::createGroup(array(
				'name'			=> 'admin',
				'permissions'	=> array(
				'admin' 		=> 1,
				),
			));

			//Membuat group regular
			$group = Sentry::createGroup(array(
				'name'			=> 'regular',
				'permissions'	=> array(
				'regular' 		=> 1,
				),
			));
		}
		catch(Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
			echo 'Name field is required';
		}
		catch(Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
			echo 'Group already exists';
		}

		try
		{
			//Membuat admin baru
			$admin = Sentry::register(array(
				//Data admin
				'email'		=> 'larapus@gmail.com',
				'password'	=> 'm4njaddawajadda',
				'first_name'	=> 'Admin',
				'last_name'	=> 'Larapus'
			), true);//akun langsung di aktifasi

			//Cari grup admin
			$adminGroup = Sentry::findGroupByName('admin');

			//Memasukan user kedalam grup admin
			$admin->addGroup($adminGroup);

			//Membuat user regular baru
			$user = Sentry::register(array(
				//data user regular
				'email'		=> 'tribudi@gmail.com',
				'password'	=> 'm4njaddawajadda',
				'first_name'=> 'Tri',
				'last_name'	=> 'Budiyono'
			), true); //langsung di aktifasi

			//Mencari grup regular
			$regularGroup = Sentry::findGroupByName('regular');

			//Memasukan user ke grup regular
			$user->addGroup($regularGroup);
		}
		catch(Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			echo 'Login field is required.';
		}
		catch(Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			echo 'Password field is required.';
		}
		catch(Cartalyst\Sentry\Users\UserExistsException $e)
		{
			echo 'Users with this login already exists.';
		}
		catch(Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
			echo 'Group was not found.';
		}
	}
}
