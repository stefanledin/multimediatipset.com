<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Game;

class GameStatusTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_admin_can_change_status_of_game()
    {
        $admin = factory(App\User::class)->create(['is_admin' => true]);
        $game = Game::create([
            'name' => 'Example game',
            'status' => 'open'
        ]);
        $this->actingAs($admin)
            ->visit('/')
            ->click('Example game')
            ->click('Redigera')
            ->select('closed', 'status')
            ->press('Spara')
            ->seeInDatabase('games', ['name' => 'Example game', 'status' => 'closed']);
    }
}
