<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'alternatives', 'worth', 'type', 'answer', 'game_id'];

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function correctAnswers()
    {
        return $this->answers->filter(function($answer) {
            return $answer->isCorrect();
        });
    }

    public function playersWithCorrectAnswers()
    {
        return $this->correctAnswers()->map(function ($answer)
        {
            return $answer->user;
        });
    }

    public function leaderBoard()
    {
        $answers = $this->answers->sortBy(function ($answer) {
            return ($answer->isCorrect()) ? 1 : 0;
        })->reverse();
        $players = $answers->map(function ($answer)
        {
            $points = ($answer->isCorrect()) ? $this->worth : 0;
            return (object) [
                'user' => $answer->user,
                'points' => $points
            ];
        });
        return (object) [
            'players' => $players
        ];
    }
}
