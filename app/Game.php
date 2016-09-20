<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Game extends Model {

    protected $fillable = ['name', 'price', 'status', 'type', 'data', 'winner'];

    public function predictions()
    {
        return $this->hasMany('App\Prediction');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function questionsWithAnswers()
    {
        return $this->questions->filter(function($question) {
            return (($question->answer != '') && ($question->answer != '-')) ? $question : null;
        });
    }

    public function pointsAvaliable()
    {
        return $this->questionsWithAnswers()->reduce(function($total, $question) {
            return $total + $question->worth;
        }, 0);
    }

    public function leaderBoard()
    {
        // Varje frågas leaderBoard hämtas och spelarna extraheras ur den.
        // Varje spelare grupperas efter ID och poängen från varje fråga
        // räknas ihop. [$player1_ID] => [$player1, $player1, $player1]
        $playerIdAndPoints = $this->questions->map(function ($question)
        {
            return $question->leaderBoard()->players->flatten()->all();
        })
        ->flatten()
        ->groupBy('id')
        ->map(function($playerGroup) {
            $points = $playerGroup->reduce(function($total, $item) {
                return $total + $item->points;
            }, 0);
            $correctAnswers = $playerGroup->reduce(function($total, $item) {
                return $total + $item->isCorrect;
            }, 0);
            return compact('points', 'correctAnswers');
        });
        $players = $playerIdAndPoints->map(function($data, $playerID) {
            $player = User::find($playerID);
            $player->points = $data['points'];
            $player->correctAnswers = $data['correctAnswers'];
            return $player;
        })->sortByDesc('points')->values();

        return (object) [
            'players' => $players
        ]; 
    }

    public function inPot()
    {
        if (count($this->predictions) != 0) {
            return count($this->predictions) * $this->price;
        }
        return 0;
    }

    public function data()
    {
        return new Game\Types\Score($this);
    }

    public function getDataAttribute($data)
    {
        return unserialize($data);
    }

    public function setDataAttribute($data)
    {
        $this->attributes['data'] = serialize($data);
    }

}
