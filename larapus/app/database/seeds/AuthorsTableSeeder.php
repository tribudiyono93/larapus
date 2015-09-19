<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AuthorsTableSeeder extends Seeder {

	public function run()
	{
		// $faker = Faker::create();

		// foreach(range(1, 10) as $index)
		// {
		// 	Author::create([

		// 	]);
		// }
		//Mengosongkan table authors
		DB::table('authors')->delete();

		//Array authors untuk di inputkan
		$authors = [
			['id' => 1, 'name' => 'Mohammad Fauzil Adhim', 'created_at' => '2015-09-19 01:20:00', 'updated_at' => '2015-09-19 01:20:00'],
			['id' => 2, 'name' => 'Salim A. Fillah', 'created_at' => '2015-09-19 01:20:00', 'updated_at' => '2015-09-19 01:20:00'],
			['id' => 3, 'name' => 'Aam Amiruddin', 'created_at' => '2015-09-19 01:20:00', 'updated_at' => '2015-09-19 01:20:00'],
		];

		//Memasukan data ke dalam table authors
		DB::table('authors')->insert($authors);
	}

}