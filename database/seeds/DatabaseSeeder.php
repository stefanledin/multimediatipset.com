<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Game;
use App\Prediction;
use App\User;

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
		$this->call('GameTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
    	$user = User::create([
    		'uid' => '1332653839',
    		'username' => 'The Ledinator',
    		'first_name' => 'Stefan',
    		'last_name' => 'Ledin',
    		'is_admin' => true
		]);
    }

}

class GameTableSeeder extends Seeder {
	public function run()
	{
        $game = Game::create(['name' => 'New York Rangers-Tampa Bay Lightning']);
        $predictions = [
        	new Prediction(['prediction' => '5-3']),
        	new Prediction(['prediction' => '2-4']),
        	new Prediction(['prediction' => '4-3'])
        ];
        $game->predictions()->saveMany($predictions);
	}
}
