<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Game;
use App\Question;
use App\Answer;

class OrderPredictionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_create_game_type_order()
    {
        $admin = factory(App\User::class)->make(['is_admin' => true]);
        $this->actingAs($admin)
            ->visit('admin/game/new')
            ->type('SHL Grundserie', 'name')
            ->type(20, 'price')
            ->press('Skapa')
            // Sparades?
            ->see('SHL Grundserie')
            // Lägg till frågan
            ->type('Sluttabell', 'title')
            ->select('Order', 'type')
            ->press('Lägg till')
            // Sparades frågan?
            ->see('Sluttabell')
            // Lägg till alternativ
            ->type('Färjestad', 'alternative[0]')
            ->press('Uppdatera')
            ->see('Färjestad')
            ->type('Frölunda', 'alternative[1]')
            ->press('Uppdatera')
            ->type('Skellefteå', 'alternative[2]')
            ->press('Uppdatera')
            ->see('Färjestad')
            ->see('Frölunda')
            ->see('Skellefteå')
            // Ange värde
            ->type(1, 'worth[default]')
            ->type(10, 'worth[alternatives][Färjestad]')
            ->type(20, 'worth[positions][1]')
            ->press('Uppdatera')
            // Sparades värdena?
            ->see('"worth[default]" value="1"')
            // (Detta är vad DOMCrawlern ser)
            ->see('"worth[alternatives][F&auml;rjestad]" value="10"')
            ->see('"worth[positions][1]" value="20"')
            ;
    }

    public function test_user_can_add_prediction()
    {
        $user = factory(App\User::class)->create(['is_admin' => false]);
        $game = Game::create([
            'name' => 'Premier League 2016'
        ]);
        $question = new Question([
            'title' => 'Sluttabell',
            'type' => 'Order',
            'alternatives' => [
                'Arsenal', 'Chelsea', 'Liverpool', 'Manchester City', 'Manchester United'
            ]
        ]);
        $game->questions()->save($question);
        $this->actingAs($user)
            ->visit('games/'.$game->id)
            ->see('Sluttabell')
            ->press('Tippa')
            ->see($user->username . ' har tippat:');
    }
}
