<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Game;
use App\Prediction;
use App\User;
use App\Question;
use App\Answer;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
		$this->call('GameTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
    	User::create([
    		'uid' => '1332653839',
    		'username' => 'CreamDiePie',
    		'first_name' => 'Stefan',
    		'last_name' => 'Ledin',
            'profile_picture_thumbnail' => 'https://scontent.xx.fbcdn.net/hprofile-xap1/v/t1.0-1/p100x100/11040855_10207584482353466_4915565750513543672_n.jpg?oh=009ae7ea8bbfe04ef323bd3229238af1&oe=56A938FC',
            'profile_picture' => 'https://scontent.xx.fbcdn.net/hprofile-xap1/v/t1.0-1/11040855_10207584482353466_4915565750513543672_n.jpg?oh=88b4ca898a36172f88a90f286b01f975&oe=565CF614',
    		'is_admin' => true
		]);
    }

}

class GameTableSeeder extends Seeder {
	public function run()
	{
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $game = Game::create([
            'name' => 'Fotbolls-EM: Grupp A',
            'price' => 20,
            'status' => 'open'
        ]);
        $question1 = new Question([
            'title' => 'Frankrike - Rumänien',
            'worth' => 5,
            'answer' => '2-1',
            'type' => 'Score'
        ]);
        $question2 = new Question([
            'title' => 'Albanien - Schweiz',
            'worth' => 1,
            'answer' => '0-1',
            'type' => 'Score'
        ]);
        $question3 = new Question([
            'title' => 'Rumänien - Schweiz',
            'worth' => 1,
            'type' => 'Score'
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
	}
}
