<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Game;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        Game::create(['name' => 'Chelsea-Liverpool']);
        Game::create(['name' => 'Sverige-Frankrike']);
        Game::create(['name' => 'Elfsborg-Malmö']);
    }

}
