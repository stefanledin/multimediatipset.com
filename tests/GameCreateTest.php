<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GameCreateTest extends TestCase {

	use DatabaseTransactions;

	public function test_admin_can_create_game_league_table()
	{
		$admin = factory(App\User::class)->create([
			'is_admin' => true
		]);
		$this->actingAs($admin);
		$this->visit('/')
			->click('Nytt')
			->seePageIs('/games/create')
			->type('SHL grundserie', 'name')
			->type('50', 'price')
			->select('LeagueTable', 'game-type')
			->select('open', 'status')
			->press('Skapa')
			->see('SHL grundserie')
			->seeInDatabase('games', ['name' => 'SHL grundserie', 'price' => 50, 'status' => 'open', 'game_type' => 'LeagueTable']);
	}

	public function test_admin_can_select_a_winner()
	{
		$admin = factory(App\User::class)->create([
			'is_admin' => true
		]);
		$this->actingAs($admin);
		$user = factory(App\User::class)->create();
		$game = App\Game::create([
            'name' => 'SHL Grundserie',
            'price' => 50,
            'status' => 'open',
            'game_type' => 'LeagueTable',
            'game_data' => serialize(['Färjestad', 'HV71', 'Frölunda', 'Linköping', 'Skellefteå'])
        ]);
        $prediction = new App\Prediction(['prediction' => serialize(['Färjestad', 'HV71', 'Frölunda', 'Linköping', 'Skellefteå'])]);
        $game->predictions()->save($prediction);
        $user->predictions()->save($prediction);

    	$this->visit('games/'.$game->id)
    		->click('Redigera')
    		->seePageIs('games/'.$game->id.'/edit')
    		->select($prediction->id, 'winner')
    		->press('Spara');

		$this->assertEquals($prediction->id, App\Game::find($game->id)->winner);
	}

	public function test_user_can_add_prediction()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$game = App\Game::create([
            'name' => 'SHL Grundserie',
            'price' => 50,
            'status' => 'open',
            'game_type' => 'LeagueTable',
            'game_data' => serialize(['Färjestad', 'HV71', 'Frölunda', 'Linköping', 'Skellefteå'])
        ]);
        
        $this->visit('/')
        	->see('SHL Grundserie')
        	->click('SHL Grundserie')
        	->seePageIs('games/'.$game->id)
        	->press('Tippa')
        	->seePageIs('games/'.$game->id)
        	->see($game->username . ' har tippat:');

        $this->assertCount(1, $game->predictions()->get());
        $this->assertCount(1, $user->predictions()->get());
	}

	public function test_user_cant_add_prediction_to_closed_game()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$game = App\Game::create([
            'name' => 'SHL Grundserie',
            'price' => 50,
            'status' => 'closed',
            'game_type' => 'LeagueTable',
            'game_data' => serialize(['Färjestad', 'HV71', 'Frölunda', 'Linköping', 'Skellefteå'])
        ]);
        
        $this->visit('/')
        	->see('SHL Grundserie')
        	->click('SHL Grundserie')
        	->seePageIs('games/'.$game->id)
        	->dontSee('Tippa');
	}

	public function test_user_cant_create_game()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);
		$this->visit('/')->dontSee('Nytt');
	}

	public function test_user_cant_visit_create_game_route()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);
		$this->visit('games/create')->seePageIs('/');
	}

	public function test_money_in_the_pot()
	{
		$game = App\Game::create([
			'price' => 20
		]);
		$game->predictions()->saveMany([
			App\Prediction::create(['prediction' => serialize(array())]),
			App\Prediction::create(['prediction' => serialize(array())])
		]);

		$this->assertEquals(40, $game->inPot());
	}

}