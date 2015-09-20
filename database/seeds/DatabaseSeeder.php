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
    	User::create([
    		'uid' => '1332653839',
    		'username' => 'CreamDiePie',
    		'first_name' => 'Stefan',
    		'last_name' => 'Ledin',
            'profile_picture_thumbnail' => 'https://scontent.xx.fbcdn.net/hprofile-xap1/v/t1.0-1/p100x100/11040855_10207584482353466_4915565750513543672_n.jpg?oh=009ae7ea8bbfe04ef323bd3229238af1&oe=56A938FC',
            'profile_picture' => 'https://scontent.xx.fbcdn.net/hprofile-xap1/v/t1.0-1/11040855_10207584482353466_4915565750513543672_n.jpg?oh=88b4ca898a36172f88a90f286b01f975&oe=565CF614',
    		'is_admin' => true
		]);
    }

}

class GameTableSeeder extends Seeder {
	public function run()
	{
        $user = User::create([
            'uid' => '12345',
            'username' => 'User 1',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'profile_picture_thumbnail' => 'http://lorempixum.com/100/100',
            'profile_picture' => 'http://lorempixum.com/500/500',
            'is_admin' => false
        ]);
        $game = Game::create([
            'name' => 'SHL Grundserie',
            'price' => 50,
            'status' => 'open',
            'game_type' => 'LeagueTable',
            'game_data' => serialize(['Färjestad', 'HV71', 'Frölunda', 'Linköping', 'Skellefteå'])
        ]);
        $prediction = new Prediction(['prediction' => serialize(['Färjestad', 'Skellefteå', 'Frölunda', 'Linköping', 'HV71'])]);
        $game->predictions()->save($prediction);
        $user->predictions()->save($prediction);
	}
}
