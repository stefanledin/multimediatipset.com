<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResultsPredictionGame extends TestCase {

    use DatabaseTransactions;

    public function test_admin_can_create_results_prediction_game()
    {
        $admin = factory(App\User::class)->create([
            'is_admin' => true
        ]);
        $this->actingAs($admin);
        $this->visit('/')
            ->click('Nytt')
            ->seePageIs('/games/create')
            ->type('Fotbolls-EM', 'name')
            ->type('20', 'price')
            ->select('Results', 'game-type')
            ->select('open', 'status')
            ->press('Skapa')
            ->see('Fotbolls-Em');
    }

    public function test_add_prediction()
    {
        $game = App\Game::create([
            'name' => 'SHL Grundserie',
            'price' => 20,
            'status' => 'open',
            'game_type' => 'Results',
            'game_data' => serialize([
                'Sverige-Italien' => 1
            ])
        ]);
        #$prediction = 
    }
}