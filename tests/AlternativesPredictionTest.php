<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Game;
use App\Question;
use App\Answer;

class AlternativesPredictionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_create_and_edit_game_type_alternatives()
    {
        $admin = factory(App\User::class)->make(['is_admin' => true]);
        $this->actingAs($admin)
            // Skapa tipset
            ->visit('/admin/game/new')
            ->type('World Cup', 'name')
            ->type(40, 'price')
            ->press('Skapa')
            // Sparades?
            ->see('World Cup')
            ->see(40)

            // Lägg till frågor
            ->type('Sverige-Ryssland', 'title')
            ->select('Alternatives', 'type')
            ->press('Lägg till')
            // Sparades?
            ->see('Redigera fråga: Sverige-Ryssland')
            ->click('Tillbaka')
            ->see('Sverige-Ryssland');
    }

    public function test_user_can_make_prediction()
    {
        $user = factory(App\User::class)->create(['is_admin' => false]);

        $game = Game::create([
            'name' => 'World Cup 2016'
        ]);
        $question1 = new Question([
            'title' => 'Sverige-Finland',
            'type' => 'Alternatives',
            'worth' => '5'
        ]);
        $question2 = new Question([
            'title' => 'Finland-Ryssland',
            'type' => 'Alternatives',
            'worth' => '1'
        ]);
        $game->questions()->saveMany([$question1, $question2]);

        $this->actingAs($user)
            ->visit('/')
            ->click('World Cup 2016')
            ->see('Sverige-Finland')
            ->see('Finland-Ryssland')
            ->select('1', 'answer['.$question1->id.']')
            ->select('2', 'answer['.$question2->id.']')
            ->press('Tippa')
            ->see($user->username. ' har tippat: <span class="badge">1</span>')
            ->see($user->username. ' har tippat: <span class="badge">2</span>');
    }

    public function test_user_cant_submit_without_prediction()
    {
        $user = factory(App\User::class)->create(['is_admin' => false]);

        $game = Game::create([
            'name' => 'World Cup träningsmatcher'
        ]);
        $question1 = new Question([
            'title' => 'Finland - Sverige',
            'type' => 'Alternatives',
            'worth' => '5'
        ]);
        $question2 = new Question([
            'title' => 'Sverige - Finland',
            'type' => 'Alternatives',
            'worth' => '1'
        ]);
        $game->questions()->saveMany([$question1, $question2]);

        $this->actingAs($user)
            ->visit('/')
            ->click('World Cup träningsmatcher')
            ->select('2', 'answer['.$question1->id.']')
            ->press('Tippa')
            ->see('Tipset för '.$question2->title.' saknas');
    }

}
