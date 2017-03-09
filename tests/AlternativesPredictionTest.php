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
            'status' => 'open',
            'worth' => '5'
        ]);
        $question2 = new Question([
            'title' => 'Finland-Ryssland',
            'type' => 'Alternatives',
            'status' => 'open',
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
            'status' => 'open',
            'worth' => '5'
        ]);
        $question2 = new Question([
            'title' => 'Sverige - Finland',
            'type' => 'Alternatives',
            'status' => 'open',
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

    public function test_user_only_sees_unanswered_questions()
    {
        $user = factory(User::class)->create();
        $game = Game::create([
            'name' => 'OS-fotboll damer',
            'status' => 'open'
        ]);
        $question1 = new Question([
            'title' => 'Sverige - Brasilien',
            'type' => 'Alternatives',
            'status' => 'open',
            'worth' => 1
        ]);
        $question2 = new Question([
            'title' => 'Tyskland - Sverige',
            'type' => 'Alternatives',
            'status' => 'open',
            'worth' => 5
        ]);
        $game->questions()->saveMany([$question1, $question2]);
        $answer = new Answer([
            'answer' => '0-0'
        ]);
        $question1->answers()->save($answer);
        $user->answers()->save($answer);
        $this->actingAs($user)
            ->visit('games/'.$game->id)
            ->see('OS-fotboll damer')
            ->dontSee('id="answer-'.$question1->id.'--"')
            ->see('id="answer-'.$question2->id.'--"');
    }

    public function test_game_has_leaderboard()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $game = Game::create([
            'name' => 'Fotbolls-EM: Grupp A',
            'price' => 20
        ]);
        $question1 = new Question([
            'title' => 'Frankrike - Rumänien',
            'worth' => 5,
            'answer' => '1',
            'type' => 'Alternatives'
        ]);
        $question2 = new Question([
            'title' => 'Albanien - Schweiz',
            'worth' => 1,
            'answer' => '2',
            'type' => 'Alternatives'
        ]);
        $question3 = new Question([
            'title' => 'Rumänien - Schweiz',
            'worth' => 1,
            'type' => 'Alternatives'
        ]);
        $game->questions()->saveMany([$question1, $question2, $question3]);
        
        $user1_question1_answer = new Answer(['answer' => '1']);
        $user1_question2_answer = new Answer(['answer' => '1']);
        $user1_question3_answer = new Answer(['answer' => '1']);
        $user1->answers()->saveMany([$user1_question1_answer, $user1_question2_answer, $user1_question3_answer]);

        $user2_question1_answer = new Answer(['answer' => 'X']);
        $user2_question2_answer = new Answer(['answer' => '2']);
        $user2_question3_answer = new Answer(['answer' => '2']);
        $user2->answers()->saveMany([$user2_question1_answer, $user2_question2_answer, $user2_question3_answer]);

        $question1->answers()->saveMany([$user1_question1_answer, $user2_question1_answer]);
        $question2->answers()->saveMany([$user1_question2_answer, $user2_question2_answer]);
        $question3->answers()->saveMany([$user1_question3_answer, $user2_question3_answer]);

        $this->assertCount(2, $game->questionsWithAnswers());
        $this->assertCount(1, $question1->correctAnswers());
        
        // $question1
        $this->assertEquals($user1->username, $question1->leaderBoard()->players[0]->username);
        $this->assertEquals($user2->username, $question1->leaderBoard()->players[1]->username);
        $this->assertEquals(5, $question1->leaderBoard()->players[0]->points);
        $this->assertEquals(0, $question1->leaderBoard()->players[1]->points);

        // $question2
        $this->assertEquals($user2->username, $question2->leaderBoard()->players[0]->username);
        $this->assertEquals($user1->username, $question2->leaderBoard()->players[1]->username);
        $this->assertEquals(1, $question2->leaderBoard()->players[0]->points);
        $this->assertEquals(0, $question2->leaderBoard()->players[1]->points);

        // $game
        $this->assertEquals(6, $game->pointsAvaliable());
        // 1. $user1->username | 5 poäng
        $this->assertEquals(5, $game->leaderBoard()->players[0]->points);
        $this->assertEquals($user1->username, $game->leaderBoard()->players[0]->username);
        
        // 2. $user2->username | 1/2 rätt | 1/6 poäng
        $this->assertEquals(1, $game->leaderBoard()->players[1]->points);

    }

}
