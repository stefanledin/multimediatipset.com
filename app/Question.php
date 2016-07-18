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
            if ($answer->answer == $this->answer) {
                 return $answer;
             } 
        });
    }

    public function playersWithCorrectAnswers()
    {
        /*return $this->answers->each(function ($answer)
        {
            $answer-
        })*/
    }
}
