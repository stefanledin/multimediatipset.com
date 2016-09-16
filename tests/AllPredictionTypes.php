<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Game;
use App\Question;
use App\Answer;
use App\User;

class AllPredictionTypes extends TestCase
{
    use DatabaseTransactions;

    public function test_all_prediction_types()
    {
        $game = Game::create([
            'name' => 'Hockey i höst',
            'price' => 100
        ]);
        $question1 = new Question([
            'title' => 'Träningsmatch: Finland-Sverige',
            'type' => 'Alternatives',
            'answer' => '1',
            'worth' => 1
        ]);
        $question2 = new Question([
            'title' => 'Träningsmatch: Sverige-Finland',
            'type' => 'Score',
            'answer' => '6-3',
            'worth' => 5
        ]);
        $question3 = new Question([
            'title' => 'World Cup: Grupp A',
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
                ],
                'positions' => [
                    '1' => 5
                ]
            ]
        ]);
        $game->questions()->saveMany([$question1, $question2, $question3]);

        // User1
        $user1 = factory(App\User::class)->create(['is_admin' => false]);
        // Rätt. 1p
        $user1_question1_answer = new Answer([
            'answer' => '1'
        ]);
        // Fel. 0p
        $user1_question2_answer = new Answer([
            'answer' => '5-2'
        ]);
        // Alla rätt. 12 poäng
        $user1_question3_answer = new Answer([
            'answer' => ['Ryssland', 'Sverige', 'Finland', 'Team Europe']
        ]);
        // 13 poäng av 18 möjliga
        $user1->answers()->saveMany([$user1_question1_answer, $user1_question2_answer, $user1_question3_answer]);
        
        // User 2
        $user2 = factory(App\User::class)->create(['is_admin' => false]);
        // Fel. 0p
        $user2_question1_answer = new Answer([
            'answer' => '2'
        ]);
        // Rätt. 5p
        $user2_question2_answer = new Answer([
            'answer' => '6-3'
        ]);
        // Två rätt. 2p
        $user2_question3_answer = new Answer([
            'answer' => ['Sverige', 'Ryssland', 'Finland', 'Team Europe']
        ]);
        // 7 poäng av 18 möjliga
        $user2->answers()->saveMany([$user2_question1_answer, $user2_question2_answer, $user2_question3_answer]);

        // Spara frågorna
        $question1->answers()->saveMany([$user1_question1_answer, $user2_question1_answer]);
        $question2->answers()->saveMany([$user1_question2_answer, $user2_question2_answer]);
        $question3->answers()->saveMany([$user1_question3_answer, $user2_question3_answer]);

        // Rätta svaren, user1
        $this->assertEquals(1, $user1_question1_answer->points());
        $this->assertEquals(0, $user1_question2_answer->points());
        $this->assertEquals(14, $user1_question3_answer->points());
        // Rätta svaren, user2
        $this->assertEquals(0, $user2_question1_answer->points());
        $this->assertEquals(5, $user2_question2_answer->points());
        $this->assertEquals(2, $user2_question3_answer->points());

        // game
        $this->assertEquals(15, $game->leaderBoard()->players[0]->points);
        $this->assertEquals(7, $game->leaderBoard()->players[1]->points);
        $this->assertEquals(20, $game->pointsAvaliable());
    }
}
