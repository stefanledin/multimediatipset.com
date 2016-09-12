<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Game;
use App\Question;
use App\Answer;
use App\User;

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

    public function test_leaderboard()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $game = Game::create([
            'name' => 'World Cup 2016'
        ]);
        $question = new Question([
            'title' => 'Grupp A',
            'type' => 'Order',
            'alternatives' => [
                'Sverige', 'Ryssland', 'Finland', 'Team Europe'
            ],
            'answer' => [
                'Ryssland', 'Sverige', 'Finland', 'Team Europe'
            ],
            'worth' => [
                'default' => 1,
                'teams' => [
                    'Sverige' => 5
                ]
            ]
        ]);
        $game->questions()->save($question);

        $answer1 = new Answer([
            'answer' => [
                'Ryssland', 'Sverige', 'Team Europe', 'Finland'
            ]
        ]);
        $question->answers()->save($answer1);
        $user1->answers()->save($answer1);
        
        $answer2 = new Answer([
            'answer' => [
                'Sverige', 'Ryssland', 'Finland', 'Team Europe'
            ]
        ]);
        $question->answers()->save($answer2);
        $user2->answers()->save($answer2);

        // $question1
        $this->assertEquals($user1->username, $question->leaderBoard()->players[0]->username);
        $this->assertEquals($user2->username, $question->leaderBoard()->players[1]->username);
        $this->assertEquals(7, $question->leaderBoard()->players[0]->points);
        $this->assertEquals(2, $question->leaderBoard()->players[1]->points);
    }

}
