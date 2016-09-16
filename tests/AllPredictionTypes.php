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

        $user1 = factory(App\User::class)->create(['is_admin' => false]);
        $user2 = factory(App\User::class)->create(['is_admin' => false]);

        $user1_question1_answer = new Answer([
            'answer' => '1'
        ]);
        $user1_question2_answer = new Answer([
            'answer' => '5-2'
        ]);
        $user1_question3_answer = new Answer([
            'answer' => ['Ryssland', 'Sverige', 'Finland', 'Team Europe']
        ]);
    }
}
