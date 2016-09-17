<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Game;
use App\Question;

class QuestionStatusTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_change_status_of_question()
    {
        $admin = factory(App\User::class)->create(['is_admin' => true]);
        $game = Game::create([
            'name' => 'Random tips',
            'status' => 'open'
        ]);
        $question1 = new Question([
            'title' => 'Question 1',
            'status' => 'open',
            'type' => 'Score'
        ]);
        $question2 = new Question([
            'title' => 'Question 2',
            'status' => 'open',
            'type' => 'Score'
        ]);
        $game->questions()->saveMany([$question1, $question2]);
        $this->actingAs($admin)
            ->visit('/')
            ->click('Random tips')
            ->see('Question 1')
            ->see('Question 2')
            ->click('Redigera')
            ->click('Redigera')
            ->see('Redigera fråga: Question 1')
            ->select('closed', 'status')
            ->press('Uppdatera')
            ->visit('games/'.$game->id)
            ->dontSee('Question 1')
            ->see('Question 2')
            ;
    }
}
