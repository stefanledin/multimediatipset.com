<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Game;
use App\Question;
use App\Answer;

class ScorePredictionTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_admin_can_create_and_edit_game_type_score()
    {
        $admin = factory(App\User::class)->make(['is_admin' => true]);
        $this->actingAs($admin)
            // Skapa tipset
            ->visit('/admin/game/new')
            ->see('Skapa nytt tips')
            ->type('Sverige - Italien', 'name')
            ->type(20, 'price')
            ->press('Skapa')
            // Sparades det?
            ->see('Sverige - Italien')
            ->see('20')
            
            // Lägg till och spara fråga
            ->type('Resultat', 'title')
            ->type('1', 'worth')
            ->see('Välj typ av tips')
            ->select('Score', 'type')
            ->press('Lägg till')
            // Sparades det?
            ->see('Frågor')
            ->see('Resultat')
            ->see('Värd: 1 poäng')
            ->see('Typ: Score')
            // Uppdatera
            ->click('Redigera')
            ->type('5', 'worth')
            ->press('Uppdatera')
            ->see('Värd: 5 poäng');
    }

    public function test_admin_can_create_game_type_score_with_multiple_questions()
    {
        $admin = factory(App\User::class)->make(['is_admin' => true]);
        $this->actingAs($admin)
            // Skapa tipset
            ->visit('/admin/game/new')
            ->see('Skapa nytt tips')
            ->type('Fotbolls-EM: Gruppspel', 'name')
            ->type(20, 'price')
            ->press('Skapa')
            
            // Lägg till och spara fråga
            ->type('Sverige - Nordirland', 'title')
            ->type('5', 'worth')
            ->see('Välj typ av tips')
            ->select('Score', 'type')
            ->press('Lägg till')
            // Lägg till och spara fråga
            ->type('Belgien - Italien', 'title')
            ->type('1', 'worth')
            ->see('Välj typ av tips')
            ->select('Score', 'type')
            ->press('Lägg till')
            
            // Sparades det?
            ->see('Frågor')
            ->see('Sverige - Nordirland')
            ->see('Belgien - Italien')
            ->see('Värd: 5 poäng')
            ->see('Värd: 1 poäng');
    }

    public function test_users_can_submit_predictions()
    {
        $user = User::create(['username' => 'Stefan']);
        $user2 = User::create(['username' => 'CreamDiePie']);
        $game = Game::create([
            'name' => 'Fotbolls-EM: Åttondelsfinaler',
            'price' => 10
        ]);
        $question1 = new Question([
            'title' => 'Italien - Spanien',
            'worth' => 1,
            'type' => 'Score'
        ]);
        $question2 = new Question([
            'title' => 'England - Island',
            'worth' => 1,
            'type' => 'Score'
        ]);
        $game->questions()->saveMany([$question1, $question2]);

        $this->actingAs($user)
            ->visit('/')
            ->see('Aktuella tips')
            ->click('Fotbolls-EM: Åttondelsfinaler')
            ->type('0-2', 'answer['.$question1->id.']')
            ->type('2-0', 'answer['.$question2->id.']')
            ->press('Tippa')
            ->seeInDatabase('answers', ['answer' => '0-2', 'user_id' => $user->id, 'question_id' => $question1->id]);
        
        $this->actingAs($user2)
            ->visit('/')
            ->click('Fotbolls-EM: Åttondelsfinaler')
            ->type('2-1', 'answer['.$question1->id.']')
            ->type('0-1', 'answer['.$question2->id.']')
            ->press('Tippa')
            ->see('Stefan har tippat: 0-2')
            ->see('Stefan har tippat: 2-0')
            ->see('CreamDiePie har tippat: 2-1')
            ->see('CreamDiePie har tippat: 0-1');
    }

    public function test_admin_can_insert_the_correct_answer_to_a_question()
    {
        $admin = factory(App\User::class)->create(['is_admin' => true]);
        $user = factory(App\User::class)->create(['is_admin' => false]);
        $game = Game::create([
            'name' => 'Fotbolls-EM: semifinaler',
            'price' => 40
        ]);
        $question = new Question([
            'title' => 'Frankrike - Tyskland',
            'worth' => 2,
            'type' => 'Score'
        ]);
        $game->questions()->save($question);
        $wrongAnswer = new Answer(['answer' => '0-5']);
        $correctAnswer = new Answer(['answer' => '2 - 0']);
        $question->answers()->saveMany([$wrongAnswer, $correctAnswer]);
        $user->answers()->save($wrongAnswer);
        $admin->answers()->save($correctAnswer);

        $this->actingAs($admin)
            ->visit('/')
            ->click('Fotbolls-EM: semifinaler')
            ->click('Redigera')
            ->see('Frankrike - Tyskland')
            ->click('Redigera')
            ->type('2-0', 'answer')
            ->press('Uppdatera');
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
            'answer' => '2-1'
        ]);
        $question2 = new Question([
            'title' => 'Albanien - Schweiz',
            'worth' => 1,
            'answer' => '0-1'
        ]);
        $question3 = new Question([
            'title' => 'Rumänien - Schweiz',
            'worth' => 1
        ]);
        $game->questions()->saveMany([$question1, $question2, $question3]);
        
        $user1_question1_answer = new Answer(['answer' => '2 - 1']);
        $user1_question2_answer = new Answer(['answer' => '1 - 0']);
        $user1_question3_answer = new Answer(['answer' => '1 - 0']);
        $user1->answers()->saveMany([$user1_question1_answer, $user1_question2_answer, $user1_question3_answer]);

        $user2_question1_answer = new Answer(['answer' => '2-0']);
        $user2_question2_answer = new Answer(['answer' => '0-1']);
        $user2_question3_answer = new Answer(['answer' => '0-1']);
        $user2->answers()->saveMany([$user2_question1_answer, $user2_question2_answer, $user2_question3_answer]);

        $question1->answers()->saveMany([$user1_question1_answer, $user2_question1_answer]);
        $question2->answers()->saveMany([$user1_question2_answer, $user2_question2_answer]);
        $question3->answers()->saveMany([$user1_question3_answer, $user2_question3_answer]);

        $this->assertCount(2, $game->questionsWithAnswers());
        $this->assertCount(1, $question1->correctAnswers());
        
        // $question1
        $this->assertEquals($user1->username, $question1->leaderBoard()->players[0]->user->username);
        $this->assertEquals($user2->username, $question1->leaderBoard()->players[1]->user->username);
        $this->assertEquals(5, $question1->leaderBoard()->players[0]->points);
        $this->assertEquals(0, $question1->leaderBoard()->players[1]->points);

        // $question2
        $this->assertEquals($user2->username, $question2->leaderBoard()->players[0]->user->username);
        $this->assertEquals($user1->username, $question2->leaderBoard()->players[1]->user->username);
        $this->assertEquals(1, $question2->leaderBoard()->players[0]->points);
        $this->assertEquals(0, $question2->leaderBoard()->players[1]->points);
        
    }

}
