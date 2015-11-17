<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScorePredictionGame extends TestCase {

	use DatabaseTransactions;

	public function test_admin_can_create_and_edit_game_score_prediction()
	{
		$admin = factory(App\User::class)->create([
			'is_admin' => true
		]);
		$this->actingAs($admin);
		$this->visit('/')
			->click('Nytt')
			->seePageIs('/games/create')
			->type('Färjestad-Linköping', 'name')
			->type('20', 'price')
			->select('Score', 'game-type')
			->select('open', 'status')
			->press('Skapa')
			->see('Färjestad-Linköping')
			->seeInDatabase('games', ['name' => 'Färjestad-Linköping', 'price' => 20, 'status' => 'open', 'game_type' => 'Score'])
			->click('Redigera')
			->type('10', 'price')
			->press('Spara');
	}

	public function test_user_can_add_score_prediction()
	{
		$user = factory(App\User::class)->create();
		$this->actingAs($user);

		$game = App\Game::create([
            'name' => 'Färjestad-Linköping',
            'price' => 20,
            'status' => 'open',
            'game_type' => 'Score'
        ]);

        $this->visit('/')
        	->see('Färjestad-Linköping')
        	->click('Färjestad-Linköping')
        	->seePageIs('games/'.$game->id)
        	->type('5-0', 'score')
        	->press('Tippa')
        	->seePageIs('games/'.$game->id)
        	->see($user->username . ' har tippat:');
	}
}